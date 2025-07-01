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
    <style>
        .table-style {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table-style th,
        .table-style td {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            vertical-align: middle;
            text-align: center;
            overflow: hidden;
        }

        .table-style th {
            background-color: #f8f9fa;
        }

        .table-style th:nth-child(1),
        .table-style td:nth-child(1),
        .table-style th:nth-child(5),
        .table-style td:nth-child(5),
        .table-style th:nth-child(6),
        .table-style td:nth-child(6),
        .table-style th:nth-child(7),
        .table-style td:nth-child(7) {
            width: 11%;
            white-space: nowrap;
        }

        .table-style th:nth-child(2),
        .table-style td:nth-child(2) {
            width: 25%;
        }

        .table-style th:nth-child(3),
        .table-style td:nth-child(3),
        .table-style th:nth-child(4),
        .table-style td:nth-child(4) {
            width: 18%;
            white-space: nowrap;
        }

        .table-style td:nth-child(1),
        .table-style td:nth-child(2) {
            word-break: break-word;
            white-space: normal;
            text-align: center;
        }

        form {
            margin: 0;
        }

        .completion-box {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
    </style>
</head>

<body class="p-2" style="max-width: 1000px; margin: auto; font-size: 0.95rem;">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Your Tasks</h4>
        <a href="template/new.php" class="btn btn-sm btn-success">Add Task</a>
    </div>

    <table class="table-style">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Date Added</th>
                <th>Time Limit</th>
                <th>Status</th>
                <th>Completion</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= $task['task_title'] ?></td>
                    <td><?= $task['task_content'] ?></td>
                    <td><?= $task['task_time'] ?></td>
                    <td><?= $task['task_space'] ?></td>


                    <td>
                        <?php
                        $is_done = !empty($task['task_done']);
                        $do_time = strtotime($task['task_space']);
                        $now = time();

                        if ($is_done) {
                            echo ' Completed';
                        } elseif ($do_time < $now) {
                            echo ' Passed';
                        } elseif ($do_time > $now) {
                            echo ' Awaiting';
                        } else {
                            echo 'Not Completed';
                        }
                        ?>
                    </td>

                    <td>
                        <form action="template/done_task.php" method="get">
                            <div class="completion-box">
                                <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">

                                <input type="checkbox" name="done" value="1"
                                    <?= $is_done ? 'checked disabled' : '' ?>>

                                <button type="submit" class="btn btn-sm btn-outline-success"
                                    <?= $is_done ? 'disabled' : '' ?>>
                                    Submit
                                </button>
                            </div>
                        </form>
                    </td>

                    <td>
                        <a href="template/delete.php?task_id=<?= $task['task_id'] ?>"
                            class="btn btn-sm btn-outline-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>