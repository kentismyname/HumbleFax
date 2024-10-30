<?php
$default_data = [
    'type'       => null,
    'from'       => null,
    'to'         => null,
    'subject'    => null,
    'sender'     => null,
    'attachment' => null,
    'createdAt'  => null,
];

setStore('upload', $default_data);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $actions = $_POST["actions"];

    if ($actions == 'btnUpload') {
        updateStore('upload', 'type', request('txt-type'));
        updateStore('upload', 'from', request('txt-from'));
        updateStore('upload', 'to', request('txt-to'));
        updateStore('upload', 'subject', request('txt-subject'));
        updateStore('upload', 'sender', request('txt-sender'));
        updateStore('upload', 'createdAt', request('txt-createdAt'));

        if (getStore('upload', 'createdAt') == null) {
            updateStore('upload', 'createdAt', timezone());
        }

        $target_dir = 'storage/uploads/';

        $file = $_FILES['fileToUpload'];

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

        $customFileName = "file_" . time() . "." . $fileExtension;

        $target_file = $target_dir . $customFileName;

        if (is_uploaded_file($file['tmp_name'])) {
            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                updateStore('upload', 'attachment', $customFileName);
            } else {
                display("Sorry, there was an error uploading your file.");
            }
        } else {
            display("No file was uploaded.");
        }

        $sql_query = "INSERT INTO `faxes`( `type`, `_from`, `_to`, `subject`, `sender`, `attachment`, `createdAt`)
            VALUES 
            (
                '" . getStore('upload', 'type') . "',               
                '" . getStore('upload', 'from') . "',               
                '" . getStore('upload', 'to') . "',               
                '" . getStore('upload', 'subject') . "',               
                '" . getStore('upload', 'sender') . "',               
                '" . getStore('upload', 'attachment') . "',               
                '" . getStore('upload', 'createdAt') . "'           
            )";

        $result = mysqli_query($db_connection, $sql_query);

        if ($result) {
            setStore('upload', $default_data, true);
            alert("Success!", 'uploads');
        } else {
            alert("Failed!");
        }
    }
}

ob_end_flush();
?>

<div id="form-content">
    <form action="uploads" method="post" enctype="multipart/form-data">
        <h1 class="title">Add Fax Record</h1>


        <p class="lbl">Type</p>
        <select id="select" name="txt-type" required onchange="updateFields()">
            <option value="Received" selected>Received</option>
            <option value="Sent">Sent</option>
        </select>


        <p class="lbl">From</p>
        <input type="text" name="txt-to" id="txt-to" placeholder="Type here" required 
               oninput="formatMultiplePhoneNumbers(this)" maxlength="32" />


        <p class="lbl">To</p>
        <input type="text" name="txt-from" id="txt-from" placeholder="Type here" 
               oninput="formatMultiplePhoneNumbers(this)" maxlength="32" required>


        <p class="lbl">Subject</p>
        <input type="text" name="txt-subject" id="txt-subject" value="PRIOR AUTHORIZATION PRESCRIPTION REQUEST" 
               readonly required />


        <p class="lbl">Sender</p>
        <input type="text" name="txt-sender" id="txt-sender" placeholder="Type here" required />


        <p class="lbl">Attachment</p>
        <input type="file" name="fileToUpload" accept="application/pdf" required>


        <p class="lbl">Created At</p>
        <input type="datetime-local" name="txt-createdAt" id="txt-createdAt" placeholder="Type here" onpaste="handlePaste(event)" />


        <button type="submit" name="actions" value="btnUpload">Submit</button>
    </form>
</div>

<script>
function formatMultiplePhoneNumbers(input) {
    let values = input.value.split('/');

    for (let i = 0; i < values.length; i++) {
        let value = values[i].replace(/\D/g, '');

        if (value.length >= 10) {
            values[i] = `(${value.substring(0, 3)}) ${value.substring(3, 6)} - ${value.substring(6, 10)}`;
        } else if (value.length >= 6) {
            values[i] = `(${value.substring(0, 3)}) ${value.substring(3, 6)}`;
        } else if (value.length >= 3) {
            values[i] = `(${value.substring(0, 3)}`;
        } else {
            values[i] = value;
        }
    }

    input.value = values.join(' / ');
}
</script>
<script>

function updateFields() {
    const typeSelect = document.getElementById('select');
    const fromField = document.getElementById('txt-to');
    const toField = document.getElementById('txt-from');
    const senderField = document.getElementById('txt-sender');
    const fixedNumber = '(207) 261 - 0798';

    if (typeSelect.value === 'Received') {
        toField.value = fixedNumber; 
        fromField.value = ''; 
        senderField.value = ''; 
    } else if (typeSelect.value === 'Sent') {
        fromField.value = fixedNumber; 
        toField.value = ''; 
        senderField.value = 'RIGHT CHOICE MEDICAL SUPPLY';
    }
}


document.addEventListener('DOMContentLoaded', function() {
    updateFields(); 
});

function handlePaste(e) {
    e.preventDefault();

    const pasteData = (e.clipboardData || window.clipboardData).getData('text').trim();

    let parsedDate = parseDateTime(pasteData);

    if (parsedDate) {
        document.getElementById('txt-createdAt').value = parsedDate;
    }
}

function parseDateTime(input) {
    let cleanedInput = input.replace(/[^0-9:\-\/\sAPMapm]/g, '');

    let datePart, timePart, amPm;

    const regexWithAmPm = /(\d{1,2})\/(\d{1,2})\/(\d{4})\s?(\d{1,2}):(\d{2})\s?(AM|PM|am|pm)?/;
    const match = cleanedInput.match(regexWithAmPm);

    if (match) {
        let [ , month, day, year, hours, minutes, period ] = match;
        month = month.padStart(2, '0');
        day = day.padStart(2, '0');
        hours = hours.padStart(2, '0');
        minutes = minutes.padStart(2, '0');

        if (period) {
            period = period.toUpperCase();
            if (period === 'PM' && hours !== '12') {
                hours = String(parseInt(hours, 10) + 12);
            } else if (period === 'AM' && hours === '12') {
                hours = '00';
            }
        }

        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    if (cleanedInput.includes('-')) {
        [datePart, timePart] = cleanedInput.split(' ');
        return `${datePart}T${timePart}`;
    }

    const regexStandard = /(\d{1,2})\/(\d{1,2})\/(\d{4})\s(\d{1,2}):(\d{2})/;
    const standardMatch = cleanedInput.match(regexStandard);

    if (standardMatch) {
        let [ , month, day, year, hours, minutes ] = standardMatch;
        month = month.padStart(2, '0');
        day = day.padStart(2, '0');
        hours = hours.padStart(2, '0');
        minutes = minutes.padStart(2, '0');

        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    return null;
}
</script>