<div class="navigation">
    <div class="sub-field pad">
        <div class="logo">
            <figure>
                <img src="<?php echo $config["imgs"] . "others/dash-logo.svg"; ?>">
            </figure>
        </div>
    </div>
    <div class="sub-field">
        <div class="separator-line"></div>
    </div>
    <div class="sub-field pad">
        <div class="menu">
            <div class="group">
                <p class="group-title"><b>Faxing</b></p>
            </div>
            <div class="group">
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon1.png"; ?>">
                        </figure>
                    </div>
                    <span>Compose New Fax</span>
                </div>
                <div class="menu-item <?php echo $requestUri == '/received-faxes' ? 'is-strong' : ''; ?>" onclick="router('received-faxes')">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon2.png"; ?>">
                        </figure>
                    </div>
                    <span>Received Faxes</span>
                </div>
                <div class="menu-item <?php echo $requestUri == '/sent-faxes' ? 'is-strong' : ''; ?>" onclick="router('sent-faxes')">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon3.png"; ?>" />
                        </figure>
                    </div>
                    <span>Sent Faxes</span>
                </div>
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon4.png"; ?>">
                        </figure>
                    </div>
                    <span>Trash Bin 10</span>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-field">
        <div class="separator-line"></div>
    </div>
    <div class="sub-field pad">
        <div class="menu">
            <div class="group">
                <p class="group-title"><b>Account</b></p>
            </div>
            <div class="group">
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon5.png"; ?>">
                        </figure>
                    </div>
                    <span>Address Book</span>
                </div>
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon6.png"; ?>">
                        </figure>
                    </div>
                    <span>Change Password</span>
                </div>
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon7.png"; ?>">
                        </figure>
                    </div>
                    <span>API / Developer</span>
                </div>
                <div class="menu-item" onclick="router('uploads')">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon8.png"; ?>">
                        </figure>
                    </div>
                    <span>Settings</span>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-field">
        <div class="separator-line"></div>
    </div>
    <div class="sub-field pad">
        <div class="menu">
            <div class="group">
                <p class="group-title"><b>Admin Features</b></p>
            </div>
            <div class="group">
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon9.png"; ?>">
                        </figure>
                    </div>
                    <span>Billing & Usage</span>
                </div>
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon10.png"; ?>">
                        </figure>
                    </div>
                    <span>Add / Manage Users 1</span>
                </div>
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon11.png"; ?>">
                        </figure>
                    </div>
                    <span>Numbers & Caller ID 1</span>
                </div>
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon12.png"; ?>">
                        </figure>
                    </div>
                    <span>Spam Filter</span>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-field">
        <div class="separator-line"></div>
    </div>
    <div class="sub-field pad">
        <div class="menu">
            <div class="group">
                <p class="group-title"><b>Site Navigation</b></p>
            </div>
            <div class="group">
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon13.png"; ?>">
                        </figure>
                    </div>
                    <span>Contact Us</span>
                </div>
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon14.png"; ?>">
                        </figure>
                    </div>
                    <span>File Formats</span>
                </div>
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon15.png"; ?>">
                        </figure>
                    </div>
                    <span>How it Works</span>
                </div>
                <div class="menu-item">
                    <div class="icon">
                        <figure>
                            <img src="<?php echo $config["imgs"] . "icons/icon16.png"; ?>">
                        </figure>
                    </div>
                    <span>Terms</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function router(name) {
        window.location.href = '<?php display($app_dir); ?>/' + name;
    }
</script>