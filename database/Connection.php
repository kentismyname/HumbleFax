<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "humblefax_db_dev";

$db_connection = new mysqli($servername, $username, $password, $dbname);

if ($db_connection->connect_error) {
    die("Connection failed: " . $db_connection->connect_error);
}
