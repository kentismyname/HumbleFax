<?php
$sql_query = "SELECT * FROM faxes WHERE type = 'Sent' ORDER BY id DESC";
$faxes = mysqli_query($db_connection, $sql_query);
$count = mysqli_num_rows($faxes);
?>
<div id="dashboard-header">
    <div class="field is-flex pad has-bc">
        <div class="group">
            <div class="section-header">
                <h2 class="section-title">Sent Faxes</h2>
                <!--<div class="line"></div>-->
                <!--<h2 class="sub-lbl">Last 30 Days</h2>-->
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
            <div class="navs">
                <div class="item">
                    <div class="_icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon-date.png"; ?>">
                        </figure>
                    </div>
                    <p>Date Range</p>
                </div>
                <div class="item">
                    <div class="_icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon-task.png"; ?>">
                        </figure>
                    </div>
                    <p>Table View</p>
                </div>
            </div>
            <div class="section-header spc-lft">
                <div class="full-line"></div>
            </div>
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
                    <p>Trash All</p>
                </div>
            </div>
        </div>
    </div>
    <div class="field is-flex pad2 has-bc2 has-bords">
        <div class="group is-flex">
            <div class="navs">
                <div class="item is-flex">
                    <div class="_icon">
                        <figure class="sml">
                            <img src="<?php echo $config["imgs"] . "icons/icon-back-fade.png"; ?>">
                        </figure>
                    </div>
                    <p class="lbl"><?php display($count); ?> of <?php display($count); ?></p>
                    <div class="_icon">
                        <figure class="sml">
                            <img src="<?php echo $config["imgs"] . "icons/icon-forward-fade.png"; ?>">
                        </figure>
                    </div>
                </div>
            </div>
            <div class="section-header spc-lft">
                <div class="line"></div>
            </div>
            <div class="navs">
                <div class="item is-flex spc-lft">
                    <p class="lbl">Deleted</p>
                    <div class="_icon">
                        <figure class="mid">
                            <img src="<?php echo $config["imgs"] . "icons/icon-del.png"; ?>">
                        </figure>
                    </div>
                </div>
            </div>
            <div class="section-header spc-lft">
                <div class="line"></div>
            </div>
            <div class="navs">
                <div class="item is-flex spc-lft">
                    <p class="lbl"><?php display($count); ?> pages
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>