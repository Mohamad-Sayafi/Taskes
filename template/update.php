<?php
require_once '../loader.php';

if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
        unset($_SESSION['success']);
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

<div class="container" style="max-width: 500px; margin-top: 50px;">
    <h4 class="mb-4 text-center">Edit data</h4>
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>
    <form action="save_updates.php" method="POST">

        <div class="mb-3">
            <label for="name" class="form-label">New Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">New Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm New password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm">
        </div>

        <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>