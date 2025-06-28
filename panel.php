<?php
session_start();
require_once 'loader.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user_tasks WHERE user_id = $user_id";
$tasks = db_select($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Tasks</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body class="p-2" style="max-width: 700px; margin: auto; font-size: 0.95rem;">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"> Your Tasks</h4>
        <a href="template/new.php" class="btn btn-sm btn-success"> Add Task</a>
    </div>

    <?php foreach ($tasks as $task): ?>
        <div class="card mb-2 p-2 d-flex justify-content-between align-items-start flex-row">
            <div class="pe-3">
                <p>Title: <?= $task['task_title'] ?></p>
                <p>Content: <?= $task['task_content'] ?></p>
            </div>

            <div class="d-flex flex-column align-items-end gap-1">

                <a href="template/delete.php?task_id=<?= $task['task_id'] ?>"
                    class="btn btn-sm btn-outline-danger" title="Delete Task">delet</a>

                <form action="template/done_task.php" method="get">
                    <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">

                    <label>
                        <input type="checkbox" name="done" value="1" <?= !empty($task['task_done']) ? 'checked disabled' : '' ?>>
                        Done
                    </label>

                    <button type="submit" class="btn btn-outline-success" <?= !empty($task['task_done']) ? 'disabled' : '' ?>>
                        Submit
                    </button>
                </form>


            </div>
        </div>
    <?php endforeach; ?>
</body>

</html>