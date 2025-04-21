<?php
session_start();

include "./admin/db/dbconnect.php";
// Check if the form is submitted
if (isset($_POST['reset_password'])) {
    // Include database connection

    // Get the email address from the form
    $email = $_POST['email'];
    $farmer_hint = $_POST['farmer_hint'];

    // Prepare SQL statement to fetch password based on email
    $sql = "SELECT farmer_password FROM tbl_farmer WHERE farmer_email = '$email' and farmer_hint = '$farmer_hint' ";

    // Execute the SQL query
    $result = $conn->query($sql);

    // Check if the query was successful and if a password was found
    if ($result->num_rows > 0) {
        // Fetch the password from the result set
        $row = $result->fetch_assoc();
        $password = $row['farmer_password'];

        // Display the password to the user
        $_SESSION["forgot_password_success"] = "Your password is:- $password";
    } else {
        // If no matching email is found, display an error message
        $_SESSION["forgot_password_fail"] = "Credintial Not found.";
    }

    // Redirect back to the same page to clear the form submission data from the URL
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .forgot-password {
        width: 300px;
        background: #fff;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .forgot-password h2 {
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

    .inputBox input[type="button"] {
        background-color: green;
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
    <div class="forgot-password">
        <h2>Forgot Password</h2>
        <?php
        if (isset($_SESSION["forgot_password_success"])) {
        ?>
        <div style="text-align: center;padding: 4px;color: green;font-weight: bold;">
            <?php echo $_SESSION["forgot_password_success"]; ?></div>
        <div class="inputBox">
            <a href="login.php">
                <input name="reset_password" type="button" value="Back to login">
            </a>
        </div>
        <?php
            unset($_SESSION["forgot_password_success"]);
        }else{
        ?>
        <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="inputBox">
                <input type="text" name="email" placeholder="Email Address" required>
            </div>
            <div>Select favorite Color for hint? </div>
            <select name="farmer_hint" style="width: 90%;padding: 10px; margin: 10px;">
                <option value="red" style="color: red;">Red</option>
                <option value="blue" style="color: blue;">Blue</option>
                <option value="green" style="color: green;">Green</option>
                <option value="yellow" style="color:  yellow;">Yellow</option>
                <option value="orange" style="color: orange;">Orange</option>
            </select>

            <div class="inputBox">
                <input type="submit" value="Show Password" name="reset_password">
            </div>
            <?php if (isset($_SESSION["forgot_password_fail"])) { ?>
            <div class="error-message"><?= $_SESSION["forgot_password_fail"] ?></div>
            <?php }}
            unset($_SESSION["forgot_password_fail"]);
            ?>
        </form>
    </div>
</body>

</html>