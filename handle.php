<?php
require_once 'loader.php';

if (isset($_POST['type'])) {
    $type = $_POST['type'];

    if ($type == 'register') {
        require_once './template/register.php';
        exit;
    } elseif ($type == 'login') {
        require_once './template/login.php';
        exit;
    } else {
        header('Location: index.php');
        exit;
    }
}
