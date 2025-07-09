<?php
session_start();
require_once '../loader.php';


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm'];
    $hashed = md5($pass);
}

if (empty($email)) {
    $_SESSION['error'] = 'Inter your email.';
    header('Location: update.php');
    exit;
}

if (empty($pass) || empty($confirm_pass)) {
    $_SESSION['error'] = 'Inter and confirm password.';
    header('Location: update.php');
    exit;
}

if ($pass !== $confirm_pass) {
    $_SESSION['error'] = 'Password is incorrect.';
    header('Location: update.php');
    exit;
} else {
    $user_id = $_SESSION['user_id'];
    $sql = "UPDATE users SET user_name = '$name', user_email = '$email', user_password = '$hashed' WHERE user_id = '$user_id'";
    $result = mysqli_query(db_connection(), $sql);
    $_SESSION['success'] = 'Data changed.';
    header('Location: update.php');
}
