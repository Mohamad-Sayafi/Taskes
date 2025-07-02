<?php

require_once 'loader.php';
session_start();


if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
        unset($_SESSION['success']);
}

// $request = $_REQUEST['q'];

// $requests = explode('/', $request);

// $first = $requests[0];


// if (!$first) {
//         echo 'home';
// }

// $routs = [
//         'login'    => 'template/login.php',
//         'panel'    => 'panel.php',
//         'register' => 'template/register.php',
//         'new'      => 'template/new.php',
//         'delete'   => 'template/delete.php',
// ];

// if (isset($routs[$first])) {
//         require_once $routs[$first];
// } else {
//         echo "'$first not found';
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <title>Sign Up Form for Taskes</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <script src="assets/js/bootstrap.min.js"></script>
        <style>
                body {
                        height: 100vh;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        background-color: #f8f9fa;
                }

                .form-container {
                        padding: 2rem;
                        background: white;
                        border-radius: 1rem;
                        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                        width: 100%;
                        max-width: 400px;
                }

                .form-label {
                        font-size: 1.1rem;
                        font-weight: 600;
                        color: #343a40;
                }

                a {
                        text-decoration: none;
                }
        </style>
</head>

<body>
        <div class="form-container">
                <h3 class="text-center mb-4">Register Form</h3>
                <form action="handle.php" method="post">
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


                        <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                        </div>
                        <div class="mb-3">
                                <label for="confirm" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm" class="form-control" id="confirm" placeholder="Re-enter password" required>
                        </div>
                        <input type="hidden" name="type" value="register">
                        <button type="submit" class="btn btn-primary w-100" name="submit">Register</button>
                </form>
                <p class="mt-3">if you have an account<a href="login.php"> login now</a></p>
        </div>
</body>

</html>