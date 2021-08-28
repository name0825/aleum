<?php
    ob_start();

    include_once '../module/ini.php';

    if (!isset($_GET['page'])) $_GET['page'] = '';
    $page = "/{$_GET['page']}";

    $config = new INI();
    $config -> setErrorLevel();
    $key = $config -> data['APP_KEY'];

    if (trim($key) == "" && $page != "/admin/setup") die("You need to setup <a href='./admin/setup'>here.</a>");

    include_once '../routes/route.php';

    if (!$app -> is_set($page, $_SERVER['REQUEST_METHOD'])) {
        if (!$app -> is_set($page, "ANY")) abort(404);
        else $app -> print_page($page, "ANY");
    }else $app -> print_page($page, $_SERVER['REQUEST_METHOD']);

    if ($config -> data['DISPLAY_ERROR'] != 1 && error_get_last() !== NULL) abort(500);
    ob_end_flush();
?>