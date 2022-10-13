<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/template/head.php';

if ($configApp['path_parts']['filename'] == 'logout') {

    unset($_SESSION['UserData']);

    header("Location: ../login.php");
    die;
}
