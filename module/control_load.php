<?php
    include_once '../module/ini.php';

    if (!isset($key) || (new INI()) -> data['APP_KEY'] != $key) {
        header("http/1.1 403 key error!");
        exit;
    }

    include_once '../module/app.php';
    $app = new APP();

    $app -> ANY("/admin/setup", function() {
        include './setup.php';
    });
?>