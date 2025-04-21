<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Registration</title>
    <link rel="stylesheet" href="workerRegister.css">
</head>

<body>
    <div class="registration-container">
        <h2>Worker Registration</h2>
        <div style="color: red; font-weight: bold;"><?= isset($_SESSION["fail"]) ? $_SESSION["fail"] : "" ?>
        </div>
        <form class="registration-form" action="worker_regitration.php" method="post" onsubmit="return validateForm()">
            <input type="text" name="head_name" placeholder="Name" required>
            <input type="text" name="head_username" placeholder="Username" required>
            <input type="password" name="head_password" placeholder="Password" required>
            <input type="text" name="head_worker" placeholder="Total Worker" required>
            <input type="text" name="head_mobile" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" placeholder="Mobile" required>
            <input type="email" name="head_email" placeholder="Email" required>
            <input type="text" name="head_address" placeholder="Address" required>
            <div style="margin: 10px;text-align: center;">Already have an account ? <a href="workerLogin.php">Login</a>
            </div>
            <input type="submit" value="Register">
        </form>
    </div>

    <script>
        function validateForm() {
            var name = document.getElementsByName("head_name")[0].value;
            var username = document.getElementsByName("head_username")[0].value;
            var password = document.getElementsByName("head_password")[0].value;
            var mobile = document.getElementsByName("head_mobile")[0].value;
            var email = document.getElementsByName("head_email")[0].value;
            var address = document.getElementsByName("head_address")[0].value;

            if (address.trim() == "" || name.trim() == "" || username.trim() == "" || password.trim() == "" || mobile
                .trim() ==
                "" || email
                .trim() == "") {
                alert("All fields must be filled out");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>