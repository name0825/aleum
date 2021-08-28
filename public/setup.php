<?php
    include_once '../module/ini.php';
    include_once '../module/setup.php';

    $set = new Setup(new INI());

    if (!$set -> check_admin()) {
        $id = 403;
        include '../pages/error.php';
        exit;
    }

    $set -> setup();
?>