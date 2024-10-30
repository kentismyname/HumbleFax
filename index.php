<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
const DS = DIRECTORY_SEPARATOR;

define('APP_PATH', dirname(__FILE__)) . DS;

session_start();

require_once APP_PATH . DS . "config" . DS . "Config.php";

require_once APP_PATH . DS . "database". DS . "Connection.php";

require_once APP_PATH . DS . "meta".DS."StartMeta.php";

require_once APP_PATH . DS . "helpers". DS."Helper.php";

require_once APP_PATH . DS . "web". DS ."Router.php";

require_once APP_PATH . DS . "meta" . DS. "EndMeta.php";
