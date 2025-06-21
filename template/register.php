<?php
session_start();
require_once './loader.php';


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm'];
    $hashed = md5($pass);
}

if (empty($email)) {
    $_SESSION['error'] = 'Inter your email.';
    header('Location: ../index.php');
    exit;
}

if (empty($pass) || empty($confirm_pass)) {
    $_SESSION['error'] = 'Inter and confirm password.';
    header('Location: index.php');
    exit;
}

if ($pass !== $confirm_pass) {
    $_SESSION['error'] = 'Password is incorrect.';
    header('Location: index.php');
    exit;
} else {
    $user_data = [
        'user_name' => $name,
        'user_email' => $email,
        'user_password' => $hashed
    ];

    $result = db_insert('users', $user_data);

    if ($result) {
        $connection = db_connection();
        $user_id = mysqli_insert_id($connection);

        $_SESSION['user_id'] = $user_id;
        $_SESSION['success'] = 'you registered, now login.';
        header('Location: index.php');
        exit;
    } else {
        echo "register failed.";
    }
}
