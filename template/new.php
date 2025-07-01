<?php ?>
<!DOCTYPE html>
<html lang="fa">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body class="bg-light p-4">
  <div class="container" style="max-width: 500px;">
    <div class="card">
      <div class="card-header bg-primary text-white">Add Task</div>
      <div class="card-body">
        <form action="add.php" method="post">
          <input type="text" class="form-control mb-3" name="task_title" placeholder="Title" required>
          <textarea class="form-control mb-3" name="task_content" rows="4" placeholder="Content" required></textarea>
          <input type="datetime-local" class="form-control mb-3" name="task_space" required>
          <button type="submit" name="submit_task" class="btn btn-success w-100">Save</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>