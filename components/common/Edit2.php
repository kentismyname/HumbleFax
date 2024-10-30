<?php
$get_recinfo = getStore('sent-info', 'info');
$default_data = [
    'type'       => null,
    'from'       => null,
    'to'         => null,
    'subject'    => null,
    'sender'     => null,
    'attachment' => null,
    'createdAt'  => null,
];

setStore('edit-rec', $default_data);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $actions = $_POST["actions"];

    if ($actions == 'btnUpload') {
        updateStore('edit-rec', 'type', request('txt-type'));
        updateStore('edit-rec', 'from', request('txt-from'));
        updateStore('edit-rec', 'to', request('txt-to'));
        updateStore('edit-rec', 'subject', request('txt-subject'));
        updateStore('edit-rec', 'sender', request('txt-sender'));
        updateStore('edit-rec', 'createdAt', request('txt-createdAt'));

        if (getStore('edit-rec', 'createdAt') == null) {
            updateStore('edit-rec', 'createdAt', timezone());
        }

        $attach = null;

        $target_dir = 'storage/uploads/';

        $file = $_FILES['fileToUpload'];

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        $customFileName = "file_" . time() . "." . $fileExtension;

        $target_file = $target_dir . $customFileName;

        if (is_uploaded_file($file['tmp_name'])) {
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                updateStore('edit-rec', 'attachment', $customFileName);
                $attach = "attachment = '" . getStore('edit-rec', 'attachment') . "',";
            } else {
                display("Sorry, there was an error uploading your file.");
            }
        }

        $sql_query = "UPDATE `faxes` SET
            type = '" . getStore('edit-rec', 'type') . "',               
            _from = '" . getStore('edit-rec', 'from') . "',               
            _to = '" . getStore('edit-rec', 'to') . "',               
            subject = '" . getStore('edit-rec', 'subject') . "',               
            sender = '" . getStore('edit-rec', 'sender') . "',               
            "  . $attach .  "            
            createdAt = '" . getStore('edit-rec', 'createdAt') . "'   
            WHERE id = " . $get_recinfo['id'] . "        
            ";

        $result = mysqli_query($db_connection, $sql_query);

        if ($result) {
            setStore('edit-rec', $default_data, true);
            $sql_query_rec = "SELECT * FROM faxes WHERE id = '" . $get_recinfo['id'] . "'";
            $rec_info = mysqli_query($db_connection, $sql_query_rec);
            if ($rec_info) {
                updateStore('sent-info', 'info', $rec_info->fetch_assoc());
                alert("Success!", 'edit-sent');
            }
        } else {
            alert("Failed!");
        }
    }
}

ob_end_flush();
?>

<div id="form-content">
    <form action="edit-sent" method="post" enctype="multipart/form-data">
        <h1 class="title">
            <figure onclick="goBack()">
                <img src="<?php echo $config["imgs"] . "icons/icon-arr-back.png"; ?>">
            </figure>
            Edit Fax Record
        </h1>
        <p class="lbl">Type</p>
        <select id="select" name="txt-type" required>
            <option <?php display($get_recinfo['type'] == 'Sent' ? 'selected' : ''); ?> value="Sent">Sent</option>
            <option <?php display($get_recinfo['type'] == 'Received' ? 'selected' : ''); ?> value="Received">Received</option>
        </select>
        <p class="lbl">From</p>
        <input type="text" name="txt-from" value="<?php display($get_recinfo['_from']); ?>" placeholder="Type here" required>
        <p class="lbl">To</p>
        <input type="text" name="txt-to" value="<?php display($get_recinfo['_to']); ?>" placeholder="Type here" required>
        <p class="lbl">Subject</p>
        <textarea name="txt-subject" placeholder="Type here" name="txt-subject" required><?php display($get_recinfo['subject']); ?></textarea>
        <p class="lbl">Sender</p>
        <input type="text" name="txt-sender" value="<?php display($get_recinfo['sender']); ?>" placeholder="Type here" required>
        <p class="lbl">Attachment</p>
        <input type="file" name="fileToUpload" accept="application/pdf">
        <p class="lbl">Created At</p>
        <input type="datetime-local" name="txt-createdAt" value="<?php display($get_recinfo['createdAt']); ?>" placeholder="Type here">
        <button type="submit" name="actions" value="btnUpload">Save</button>
    </form>
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>