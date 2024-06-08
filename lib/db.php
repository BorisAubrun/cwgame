<?php

$user = "root";
$pwd = "";
$db_name = "cw";
$server = "localhost";

try {
    $db = new PDO("mysql:host=$server;dbname=$db_name", $user, $pwd);
} catch (PDOException $e) {
    if ($server == "localhost") {
        $error_msg = '<p class="txt-info">' . $e->getMessage() . '</p>;';
    }
}
