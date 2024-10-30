<div id="dashboard-layout">
    <div class="content is-flex">
        <div class="field has-bc left">
            <?php require_once $config["components"] . "common/Navigation.php"; ?>
        </div>
        <div class="field right">
            <div class="component">
                <?php require_once $config["components"] . "common/Header.php"; ?>
                <?php require_once $config["components"] . "common/ReceivedFaxes.php"; ?>
            </div>
        </div>
    </div>
</div>