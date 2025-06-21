<?php
session_start();
require_once 'loader.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    $_SESSION['error'] = 'Please fill in both email and password.';
    header('Location: login.php');
    exit;
}

$connection = db_connection();

$sql = "SELECT * FROM users WHERE user_email = '$email'";
$user = db_select_one($sql);

if (!$user) {
    $_SESSION['error'] = 'Invalid email or password.';
    header('Location: login.php');
    exit;
}

if (md5($password) == $user['user_password']) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['success'] = 'Login successful.';
    header('Location: panel.php');
    exit;
} else {
    $_SESSION['error'] = 'Invalid email or password.';
    header('Location: login.php');
    exit;
}
