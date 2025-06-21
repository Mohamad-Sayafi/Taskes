<?php
session_start();
require_once '../loader.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];
    $done = (isset($_GET['done']) && $_GET['done'] == 1) ;

    $connection = db_connection();

    $sql_check = "SELECT * FROM user_tasks WHERE task_id = $task_id";
    $task = mysqli_fetch_assoc(mysqli_query($connection, $sql_check));

    if ($task) {
        $sql_update = "UPDATE user_tasks SET task_done = $done WHERE task_id = $task_id";
        mysqli_query($connection, $sql_update);
    }
}

header('Location: ../panel.php');
exit;
