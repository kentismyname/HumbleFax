<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
    exit();
}

$inputData = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE || !isset($inputData['records'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
    exit();
}

require './database/Connection.php';

$pdfFolder = './storage/uploads/';

if (!file_exists($pdfFolder)) {
    mkdir($pdfFolder, 0777, true);
}


$insertedRecords = [];


foreach ($inputData['records'] as $record) {
    $recordData = array_merge([
        'type' => null,
        'from' => null,
        'to' => null,
        'subject' => null,
        'sender' => null,
        'attachment' => null,
        'createdAt' => date('Y-m-d H:i:s'), 
    ], $record);


    if (empty($recordData['type']) || empty($recordData['from']) || empty($recordData['to']) || empty($recordData['subject']) || empty($recordData['sender'])) {
        echo json_encode(['status' => 'error', 'message' => 'Required fields missing']);
        exit();
    }

    if (!empty($recordData['attachment'])) {
        $fileContent = base64_decode($recordData['attachment'], true);

        if ($fileContent === false) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid base64 file content']);
            exit();
        }

        $fileExtension = $recordData['file_extension'] ?? 'pdf';
        $customFileName = 'file_' . time() . '_' . rand(1000, 9999) . '.' . $fileExtension;
        $target_file = $pdfFolder . $customFileName;

        if (file_put_contents($target_file, $fileContent)) {
            $recordData['attachment'] = $customFileName;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'File upload failed']);
            exit();
        }
    }

    $stmt = $db_connection->prepare("
        INSERT INTO `faxes` (`type`, `_from`, `_to`, `subject`, `sender`, `attachment`, `createdAt`)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        'sssssss',
        $recordData['type'],
        $recordData['from'],
        $recordData['to'],
        $recordData['subject'],
        $recordData['sender'],
        $recordData['attachment'],
        $recordData['createdAt']
    );

    if ($stmt->execute()) {
        $insertedRecords[] = $recordData;
    } else {
        error_log("Error inserting record: " . $stmt->error);
    }

    $stmt->close();
}

if (!empty($insertedRecords)) {
    echo json_encode(['status' => 'success', 'inserted_records' => $insertedRecords]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No records were inserted']);
}

?>
