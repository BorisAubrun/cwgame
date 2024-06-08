<?php 
    session_start();
    require_once('lib/lib.php');

    $user = new User($db);
    $user->logout();

?>