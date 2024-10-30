<?php
?>

<div id="pdfModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modal-pdf-container" class="modal-pdf"></div>
    </div>
</div>


<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.8);
    }

    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        height: 80%;
        overflow: auto;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        position: sticky;
        top: 0;
        right: 0;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
    }

    .modal-pdf {
        width: 100%;
        height: 100%;
    }
</style>



<div id="component-body">
    <div class="is-flex">
        <div class="box">
            <?php
            $attachments = [];
            echo '<div class="pdf-card">';
            ?>
            <div class="head vwr">
                <div class="det">
                    <p class="pd-lft txt-al-c">Fax Receive Successful</p>
                </div>
                <div class="options">
                    <div class="sub-menu">
                        <div class="select">
                            <div class="icon">
                                <figure>
                                    <img src="<?php echo $config["imgs"] . "icons/icon-search2.png"; ?>">
                                </figure>
                            </div>
                            <p>View Details</p>
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
            </div>
            <?php
            echo '<div id="pdf-container-' . $get_recinfo['id'] . '" class="pdf-item mid" ></div>';
            $attachments[] = [
                'file' => $get_recinfo['attachment'],
                'id' => $get_recinfo['id']
            ];
            echo '</div>';
            // }
            ?>
            <script>
                document.addEventListener("DOMContentLoaded", async function() {
    async function onLoad(attachments) {
        for (const { file, id } of attachments) {
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

        const viewport = page.getViewport({ scale: 1 });
        const containerWidth = container.clientWidth;
        const containerHeight = container.clientHeight;
        const scale = Math.min(containerWidth / viewport.width, containerHeight / viewport.height);
        const scaledViewport = page.getViewport({ scale });

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

        container.style.cursor = 'pointer';
        container.onclick = function() {
            openModal(url);
        };
    }

    function openModal(pdfUrl) {
        const modal = document.getElementById('pdfModal');
        const modalPdfContainer = document.getElementById('modal-pdf-container');

        modalPdfContainer.innerHTML = '';

        pdfjsLib.getDocument(pdfUrl).promise.then(async function(pdf) {
            const totalPages = pdf.numPages;

            for (let pageNum = 1; pageNum <= totalPages; pageNum++) {
                await renderPDFPage(pdf, pageNum, modalPdfContainer);
            }
        });

        modal.style.display = "block";

        const closeButton = document.getElementsByClassName('close')[0];
        closeButton.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }

    async function renderPDFPage(pdf, pageNum, container) {
        const page = await pdf.getPage(pageNum);
        const viewport = page.getViewport({ scale: 1.5 });

        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = viewport.width;
        canvas.height = viewport.height;
        canvas.style.marginBottom = '10px';

        const renderContext = {
            canvasContext: context,
            viewport: viewport,
        };

        await page.render(renderContext).promise;
        container.appendChild(canvas);
    }

    onLoad(<?php echo json_encode($attachments); ?>);
});

            </script>
        </div>
        <div class="box">
            <div class="details">
                <div class="info">
                    <p><b>From</b></p>
                    <p><?php display($get_recinfo['_to']); ?></p>
                </div>
                <div class="info">
                    <p><b>To</b></p>
                    <p><?php display($get_recinfo['_from']); ?></p>
                </div>
                <div class="info">
                    <p><b>Number of Pages</b></p>
                    <p>5</p>
                </div>
                <div class="info">
                    <p><b>Transmission Time</b></p>
                    <p> <?php display(timeAgo($get_recinfo['createdAt'])); ?></p>
                </div>
            </div>
        </div>
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