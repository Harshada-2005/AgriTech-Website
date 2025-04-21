<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .signin {
        width: 300px;
        background: #fff;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .signin h2 {
        font-size: 24px;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .inputBox {
        margin-bottom: 20px;
    }

    .inputBox input {
        width: 90%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
    }

    .inputBox select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
    }

    .inputBox i {
        font-style: italic;
        color: #888;
    }

    .inputBox input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        padding: 10px;
        border-radius: 5px;
        width: 100%;
        transition: background-color 0.3s;
    }

    .inputBox input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 10px;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="signin">
        <h2 id="loginHeading">Login (Member)</h2>
        <?php
        if (isset($_SESSION["success_farmer"])) {
        ?>
        <div style="text-align: center;padding: 3px;color: green;font-weight: bold;">
            <?php echo $_SESSION["success_farmer"]; ?></div>
        <?php
            unset($_SESSION["success_farmer"]);
        }
        ?>
        <form class="form" action="login-verify.php" method="post">
            <div class="inputBox">
                <input type="text" name="email" placeholder="Email Address" required>
            </div>
            <div class="inputBox">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="inputBox">
                <select name="userType" id="userType" style="width: 100%; padding: 10px;" onchange="updateHeading()">
                    <option value="1">Member</option>
                    <option value="2">Consultant</option>
                </select>
            </div>
            <div style="display: flex;justify-content: space-between;padding-bottom: 20px;">
                <div>
                    <a href="register_farmer.php" id="registerLink">Register</a>
                </div>
                <div>
                    <a href="forgot_password.php" id="forgotPasswordLink">Forgot Password</a>
                </div>

            </div>
            <div class="inputBox">
                <input type="submit" value="Login" name="login">
            </div>
            <div class="inoutBox" style="display: flex;justify-content: space-between;">
                <div class="">Login As</div>
                <div style="width: 45%;display: flex; justify-content: space-between;">

                    <a href="admin/index.php" style="cursor: pointer;">
                        Admin
                    </a>
                    <div>Or</div>
                    <a href="workerLogin.php" style="cursor: pointer;">
                        Worker
                    </a>
                </div>
            </div>
            <?php if (isset($_SESSION["fail"])) { ?>
            <div class="error-message"><?= $_SESSION["fail"] ?></div>
            <?php }
            unset($_SESSION["fail"]);
            ?>
        </form>
    </div>

    <script>
    function updateHeading() {
        var userType = document.getElementById("userType").value;
        var heading = document.getElementById("loginHeading");
        var forgotPasswordLink = document.getElementById("forgotPasswordLink");
        var registerLink = document.getElementById("registerLink");

        if (userType == 1) {
            heading.textContent = "Login (Member)";
            forgotPasswordLink.style.display = "block"; // Show the "Forgot Password" link
            registerLink.style.display = "block"; // Show the "Register" link
        } else if (userType == 2) {
            heading.textContent = "Login (Consultant)";
            forgotPasswordLink.style.display = "none"; // Hide the "Forgot Password" link
            registerLink.style.display = "none"; // Hide the "Register" link
        }
    }
    </script>
</body>

</html>