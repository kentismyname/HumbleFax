<?php
$default_data = [
    'info' => null,
];

setStore('sent-info', $default_data);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $actions = $_POST["actions"];

    if ($actions == 'btnSentInfo') {
        $sql_query_rec = "SELECT * FROM faxes WHERE id = '" . request("txt-id") . "'";
        $rec_info = mysqli_query($db_connection, $sql_query_rec);
        if ($rec_info) {
            updateStore('sent-info', 'info', $rec_info->fetch_assoc());
            router("sent-faxes-viewer");
        }
    }
}


$sql_query_faxes = "SELECT * FROM faxes WHERE type = 'Sent' ORDER BY createdAt DESC";
$faxes = mysqli_query($db_connection, $sql_query_faxes);
?>

<div id="component-body">
    <div class="pdf-area">
        <?php
        $attachments = [];
        while ($row = $faxes->fetch_assoc()) {
            echo '<div class="pdf-card" onmouseleave="toggleOption(' . $row['id'] . ', true)">';
        ?>
            <div class="upper">
                <p><b><?php display(formatDate($row["createdAt"], "M jS")); ?></b>&nbsp; <?php display(formatDate($row["createdAt"], "g:ia")); ?></p>
                <p><b><?php display($row["_from"]); ?></b></p>
            </div>
            <div class="head">
                <div class="det">
                    <p class="pd-lft">Fax Send Successful</p>
                    <div class="_icon" onclick="toggleOption(<?php display($row['id']); ?>)">
                        <figure class="sml">
                            <img src="<?php echo $config["imgs"] . "icons/icon-dot.png"; ?>">
                        </figure>
                    </div>
                </div>
                <form action="sent-faxes" method="post">
                    <div class="options" id="option-<?php display($row["id"]); ?>">
                        <div class="sub-menu">
                            <div class="select">
                                <button type="submit" name="actions" value="btnSentInfo">
                                    <div class="icon">
                                        <figure>
                                            <img src="<?php echo $config["imgs"] . "icons/icon-search2.png"; ?>">
                                        </figure>
                                    </div>
                                    <input type="hidden" name="txt-id" value="<?php display($row['id']) ?>">

                                    View Details
                                </button>
                            </div>
                            <div class="select">
                                <div class="icon">
                                    <figure>
                                        <img src="<?php echo $config["imgs"] . "icons/icon-download2.png"; ?>">
                                    </figure>
                                </div>
                                <p>Download PDF</p>
                            </div>
                            <div class="select">
                                <div class="icon">
                                    <figure>
                                        <img src="<?php echo $config["imgs"] . "icons/icon-reply-back.png"; ?>">
                                    </figure>
                                </div>
                                <p>Reply</p>
                            </div>
                            <div class="select">
                                <div class="icon">
                                    <figure>
                                        <img src="<?php echo $config["imgs"] . "icons/icon-reply-forward.png"; ?>">
                                    </figure>
                                </div>
                                <p>Forward</p>
                            </div>
                            <div class="select">
                                <div class="icon">
                                    <figure>
                                        <img src="<?php echo $config["imgs"] . "icons/icon-unread.png"; ?>">
                                    </figure>
                                </div>
                                <p>Mark as Unread</p>
                            </div>
                            <div class="select">
                                <div class="icon">
                                    <figure>
                                        <img src="<?php echo $config["imgs"] . "icons/icon-trash-red.png"; ?>">
                                    </figure>
                                </div>
                                <p>Send to Trash</p>
                            </div>
                            <div class="select no-bot">
                                <div class="icon">
                                    <figure>
                                        <img src="<?php echo $config["imgs"] . "icons/icon-message.png"; ?>">
                                    </figure>
                                </div>
                                <p>Report a Problem</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php
            echo '<div id="pdf-container-' . $row['id'] . '" class="pdf-item" ></div>';
            $attachments[] = [
                'file' => $row['attachment'],
                'id' => $row['id']
            ];
            echo '</div>';
        }
        ?>
        <script>
            document.addEventListener("DOMContentLoaded", async function() {
                async function onLoad(attachments) {
                    for (const {
                            file,
                            id
                        }
                        of attachments) {
                        await renderPDF(file, 'pdf-container-' + id);
                    }
                }

                async function renderPDF(attachment, containerId) {
                    const url = "storage/uploads/" + attachment;
                    const pdf = await pdfjsLib.getDocument(url).promise;
                    const page = await pdf.getPage(1);

                    const container = document.getElementById(containerId);
                    if (!container) {
                        console.error('Container not found:', containerId);
                        return;
                    }

                    await new Promise(resolve => setTimeout(resolve, 100));

                    const containerWidth = container.clientWidth;
                    const containerHeight = container.clientHeight;

                    console.log('Container width:', containerWidth, 'Container height:', containerHeight);

                    if (containerWidth === 0 || containerHeight === 0) {
                        console.error('Container dimensions are zero. Check visibility or CSS styles.');
                        return;
                    }

                    const viewport = page.getViewport({
                        scale: 1
                    });
                    const scale = Math.min(containerWidth / viewport.width, containerHeight / viewport.height);
                    const scaledViewport = page.getViewport({
                        scale
                    });

                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.width = scaledViewport.width;
                    canvas.height = scaledViewport.height;
                    container.appendChild(canvas);

                    const renderContext = {
                        canvasContext: context,
                        viewport: scaledViewport,
                    };
                    await page.render(renderContext).promise;
                }

                onLoad(<?php echo json_encode($attachments); ?>);
            });
        </script>
    </div>
</div>
<script>
    function toggleOption(id, remove = false) {
        const element = document.getElementById('option-' + id);

        if (!remove) {
            if (element.classList.contains('active')) {
                element.classList.remove('active');
            } else {
                element.classList.add('active');
            }
        } else {
            if (element.classList.contains('active')) {
                element.classList.remove('active');
            }
        }

    }
</script>