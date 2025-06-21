<?php
session_start();
require_once '../loader.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['submit_task'])) {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['task_title'];
    $content = $_POST['task_content'];

    $data = [
        'user_id' => $user_id,
        'task_title' => $title,
        'task_content' => $content
    ];

    if (db_insert('user_tasks', $data)) {
        $_SESSION['success'] = 'Task added successfully.';
    } else {
        $_SESSION['error'] = 'Failed to add task.';
    }

    header('Location: ../panel.php');
    exit;
}
