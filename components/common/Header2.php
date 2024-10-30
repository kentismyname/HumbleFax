<?php
$get_recinfo = getStore('recieved-info', 'info');
?>
<div id="dashboard-header">
    <div class="field is-flex pad has-bc">

        <div class="group is-flex">
            <div class="arr-back" onclick="goBack()">
                <figure>
                    <img src="<?php echo $config["imgs"] . "icons/icon-arr-back.png"; ?>">
                </figure>
            </div>
            <div class="section-header">
                <h2 class="section-title">Fax From <?php display($get_recinfo['_to']) ?></h2>
            </div>
        </div>
        <div class="group">
            <div class="section-header">
                <div class="icon">
                    <figure>
                        <img src="<?php echo $config["imgs"] . "icons/icon-notif.PNG"; ?>">
                    </figure>
                </div>
                <div class="line"></div>
                <h2 class="sub-lbl"><b>Right Choice Medical Supplies</b></h2>
                <div class="line"></div>
                <h2 class="sub-lbl">(207) 261 - 0798</h2>
            </div>
        </div>
    </div>
    <div class="field is-flex pad2 has-bc2 has-bords">
        <div class="group is-flex">
            <div class="navs spc-lft">
                <div class="item">
                    <div class="_icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon-download.png"; ?>">
                        </figure>
                    </div>
                    <p>Download All</p>
                </div>
                <div class="item">
                    <div class="_icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon-trash.png"; ?>">
                        </figure>
                    </div>
                    <p>All Page</p>
                </div>
                <div class="item">
                    <div class="_icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon-trash.png"; ?>">
                        </figure>
                    </div>
                    <p>Print</p>
                </div>
                <div class="item">
                    <div class="_icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon-reply-forward.png"; ?>">
                        </figure>
                    </div>
                    <p>Forward</p>
                </div>
                <div class="item">
                    <div class="_icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon-add-contact.png"; ?>">
                        </figure>
                    </div>
                    <p>Save Contact</p>
                </div>
                <div class="item">
                    <div class="_icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon-task.png"; ?>">
                        </figure>
                    </div>
                    <p>Access Stats</p>
                </div>
            </div>
            <div class="section-header spc-lft">
                <div class="full-line"></div>
            </div>
            <div class="navs">
                <div class="item">
                    <div class="_icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon-try.png"; ?>">
                        </figure>
                    </div>
                    <p>Send Again</p>
                </div>
                <div class="item">
                    <div class="_icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon-trash-red.png"; ?>">
                        </figure>
                    </div>
                    <p>Trash Fax</p>
                </div>
            </div>


        </div>
    </div>
    <div class="field is-flex pad2 has-bc2 has-bords">
        <div class="group is-flex">
            <div class="navs">
                <div class="item is-flex has-curs">
                    <p class="lbl" onclick="router('edit');"><?php display(formatDate($get_recinfo["createdAt"], "M jS")); ?></b>&nbsp; <?php display(formatDate($get_recinfo["createdAt"], "g:ia")); ?> EST</p>
                </div>
            </div>
            <div class="section-header spc-lft">
                <div class="line"></div>
            </div>
            <div class="navs">
                <div class="item is-flex spc-lft">
                    <div class="_icon">
                        <figure class="sml">
                            <img src="<?php echo $config["imgs"] . "icons/icon-back-fade.png"; ?>">
                        </figure>
                    </div>
                    <p class="lbl">Page 1 of 5</p>
                    <div class="_icon">
                        <figure class="sml">
                            <img src="<?php echo $config["imgs"] . "icons/icon-forward-fade.png"; ?>">
                        </figure>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function goBack() {
        window.history.back();
    }

    function router(name) {
        window.location.href = '<?php display($app_dir); ?>/' + name;
    }
</script>