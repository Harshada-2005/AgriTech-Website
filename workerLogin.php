<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="worker.css">
</head>

<body>
    <div class="login-container">
        <h2>Login (Worker)</h2>
        <div style="text-align: center;color: red;">
            <?php
            if (isset($_GET['error'])) {
                echo "<p class='error'>Invalid username or password !</p>";
            }
            ?>
        </div>
        <div style="text-align: center;color: green;font-weight: bold;">

            <?php if (isset($_SESSION["success"])) {
                echo $_SESSION["success"];
            }
            unset($_SESSION["success"]);
            ?>
        </div>
        <form class="login-form" action="worker_login_verify.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div style="margin: 10px;text-align: center;">Not have an account ? <a
                    href="workerRegister.php">Register</a> </div>
            <input type="submit" value="Login">
            <div style="display: flex; justify-content: space-between; margin: 10px;">
                <div>Login As</div>
                <div>

                    <a href="login.php">Farmer</a> Or <a href="admin/index.php">Admin</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>