<div id="dashboard-layout">
    <div class="content is-flex">
        <div class="field has-bc left">
            <?php require_once $config["components"] . "common/Navigation.php"; ?>
        </div>
        <div class="field right">
            <div class="component">
                <?php require_once $config["components"] . "common/Header4.php"; ?>
                <?php require_once $config["components"] . "common/SentFaxesViewer.php"; ?>
            </div>
        </div>
    </div>
</div>