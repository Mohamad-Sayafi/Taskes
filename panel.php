<?php
session_start();
require_once 'loader.php';
date_default_timezone_set('Asia/Tehran');

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
    <link rel="stylesheet" href="assets/css/all.min.css">
    <script src="assets/js/all.min.js"></script>
    <style>
        body {
            font-size: 0.9rem;
        }

        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        @media (max-width: 992px) {
            .tasks-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .tasks-grid {
                grid-template-columns: 1fr;
            }
        }

        .task-card {
            border: 1px solid #dee2e6;
            border-radius: 0.75rem;
            padding: 1rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #fff;
        }

        .task-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
            text-wrap: wrap;
        }

        .task-label {
            font-weight: 500;
            margin-bottom: 0.2rem;
            color: #333;
            font-size: 1.4rem;
        }

        .task-text {
            font-size: 0.85rem;
            color: #555;
            margin-bottom: 0.6rem;
            white-space: pre-wrap;
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .task-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.5rem;
        }

        .badge-status {
            font-size: 0.75rem;
            padding: 0.3em 0.6em;
        }

        .completion-box {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-sm {
            font-size: 0.75rem;
            padding: 0.25rem 0.6rem;
        }

        .bottom-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 0.6rem;
            margin-top: auto;
        }

        .bottom-info div span {
            display: block;
            font-weight: 500;
            color: #333;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
        }

        .header-bar h4 {
            font-size: 1.4rem;
            font-weight: bold;
        }

        .header-bar a {
            font-size: 0.95rem;
        }
        .profile{
            justify-content: center;
            align-items: center;
            align-content: center;
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body class="p-3" style="max-width: 1200px; margin: auto;">
    <div class="header-bar">
        <h4>Your Tasks</h4>
        <div class="profile">
            <a href="template/new.php" class="btn btn-success btn-sm">+ Add Task</a>
            <a href="template/update.php"><i class="fa-solid fa-circle-user" style="font-size :x-large; color:gray;"></i></a>
        </div>
    </div>

    <div class="tasks-grid">
        <?php foreach ($tasks as $task): ?>
            <?php
            $is_done = !empty($task['task_done']);
            $do_time = strtotime($task['task_space']);
            $now = time();

            if ($is_done) {
                $status = 'Completed';
            } elseif ($do_time < $now) {
                $status = 'Passed';
            } elseif ($do_time > $now) {
                $status = 'Awaiting';
            } else {
                $status = 'Not Completed';
            }
            ?>

            <div class="task-card">
                <div class="task-header">
                    <div style="flex: 1;">
                        <div class="task-label">Title:</div>
                        <div class="task-title"><?php echo $task['task_title']; ?></div>

                        <div class="task-label">Content:</div>
                        <div class="task-text"><?php echo $task['task_content']; ?></div>
                    </div>

                    <div class="task-actions">
                        <span class="badge-dark badge-status">
                            <label class="task-label">Status:</label><br>
                            <?= $status ?></span>

                        <form action="template/done_task.php" method="get" class="completion-box">
                            <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
                            <input type="checkbox" name="done" value="1" <?= $is_done ? 'checked disabled' : '' ?>>
                            <button type="submit" class="btn btn-outline-success btn-sm"
                                <?= $is_done ? 'disabled' : '' ?>>Submit</button>
                        </form>

                        <a href="template/delete.php?task_id=<?= $task['task_id'] ?>" class="btn btn-outline-danger btn-sm">
                            Delete
                        </a>
                    </div>
                </div>

                <div class="bottom-info">
                    <div>
                        Date Added:
                        <span><?php echo time_ago($task['task_time']); ?></span>
                    </div>
                    <div style="text-align: right;">
                        Time Limit:
                        <br>
                        <?php

                        $now = time();
                        $expire = strtotime($task['task_space']);
                        $difference = $expire - $now;

                        if ($now > $expire) {
                            echo "task passed";
                        } elseif ($difference < 3600) {
                            echo floor($difference / 60) . " minutes left";
                        } else {
                            $hours = floor($difference / 3600);
                            echo "$hours hours left";
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>