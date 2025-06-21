<?php
session_start();
require_once '../loader.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    $user_id = $_SESSION['user_id'];

    db_delete('user_tasks', [
        'task_id' => $task_id,
        'user_id' => $user_id
    ]);
}

header('Location: ../panel.php');
exit;
