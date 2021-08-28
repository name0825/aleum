<?php
    include_once '../module/http_error_code.php';

    $id = $id ?? 500;
?>
<html>
    <head>
        <title><?php echo $id; ?></title>
        <meta charset='utf-8'>
        <!-- include css -->
        <link rel="stylesheet" href="/font/font.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <!-- include js -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </head>
    <body>
        <style>
            body { background-color: rgba(215, 190, 255, .7); }
            a:link { color: black; text-decoration: none; }
            a:visited { color: black; text-decoration: none; }
            a:hover { color: black; text-decoration: none; }
            h1 { font-family: 'SLEIGothicOTF'; margin-top: 15%; color: rgba(150, 140, 200, .6); }
            .w { color: #fff; }
        </style>
        <div calss="container mt-5 mb-5">
            <h1 class="text-center"><?php echo $id; ?> <span class="w">I</span> <?php echo isset($http_error_code[$id]) ? $http_error_code[$id] : "UNKNOWN"; ?></h1>
        </div>
    </body>
</html>