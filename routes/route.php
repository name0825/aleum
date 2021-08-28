<?php
    include_once '../module/control_load.php';

    $app -> ANY("/", function() {
        echo "Hello world!";
    });
?>