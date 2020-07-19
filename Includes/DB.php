<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$db_name = "cms_system";

try {
    $db = new PDO("mysql:host=$serverName;dbname=$db_name", $userName, $password);
    //echo "Connected";

} catch (PDOException $e) {
    echo "Connection Failed" . $e;
}
