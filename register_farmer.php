<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        width: 300px;
        background: #fff;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
        font-size: 24px;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .input-box {
        margin-bottom: 20px;
    }

    .input-box input {
        width: 95%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
    }

    .submit-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        padding: 10px;
        border-radius: 5px;
        width: 100%;
        transition: background-color 0.3s;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }
    </style>
</head>
<?php

include "admin/db/dbconnect.php";

if (isset($_POST["save_farmer"])) {
    $farmer_full_name = $_POST['farmer_full_name'];
    $farmer_email = $_POST['farmer_email'];
    $farmer_phone_number = $_POST['farmer_mobilenumber'];
    $farmer_address = $_POST['farmer_address'];
    $farmer_hint = $_POST['farmer_hint'];
    $farmer_password = $_POST['farmer_password'];

    // Check if the farmer_full_name already exists
    $check_name_sql = "SELECT * FROM tbl_farmer WHERE farmer_fullname = '$farmer_full_name'";
    $check_name_result = $conn->query($check_name_sql);

    if ($check_name_result->num_rows > 0) {
        // Farmer with the same farmer_full_name already exists
        $_SESSION["fail"] = "A farmer with the same name already exists!";
        header("Location: register_farmer.php"); // Redirect back to registration page
        exit(); // Terminate the script
    }

    // Check if the farmer_email already exists
    $check_email_sql = "SELECT * FROM tbl_farmer WHERE farmer_email = '$farmer_email'";
    $check_email_result = $conn->query($check_email_sql);

    if ($check_email_result->num_rows > 0) {
        // Farmer with the same farmer_email already exists
        $_SESSION["fail"] = "A farmer with the same email already exists!";
        header("Location: register_farmer.php"); // Redirect back to registration page
        exit(); // Terminate the script
    }

    // Insert data into tbl_farmer table
    $sql = "INSERT INTO tbl_farmer (farmer_fullname, farmer_email, farmer_mobilenumber, farmer_address, farmer_password, farmer_hint) 
    VALUES ('$farmer_full_name', '$farmer_email', '$farmer_phone_number', '$farmer_address', '$farmer_password', '$farmer_hint')";

    if ($farmer_full_name == "") {
        $_SESSION["fail"] = "The fields marked with an asterisk (*) are mandatory and must be filled out to proceed with the form submission.";
    } else if ($conn->query($sql) === TRUE) {
        $_SESSION['success_farmer'] = "Farmer registered successfully!";
        echo "<script>window.location.href = 'login.php'; </script>";
    } else {
        $_SESSION['fail'] = "Something went wrong!";
    }

    $conn->close();
}

?>

<body>
    <div class="form-container">
        <h2>Register</h2>
        <form action="" method="post">
            <div style="margin-bottom: 10px; font-weight: bold;font-size: 15px;  text-align: center;color: red;">

                <div style="color: red; font-weight: bold;"><?= isset($_SESSION["fail"]) ? $_SESSION["fail"] : "" ?>
                </div>
            </div>
            <div class="input-box">
                <input type="text" name="farmer_full_name" placeholder="Full Name" required>
            </div>

            <div class="input-box">
                <input type="number" name="farmer_mobilenumber" placeholder="Mobile Number"
                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    maxlength="10" required>

            </div>
            <div class="input-box">
                <input type="text" name="farmer_email" placeholder="Email Address" required>
            </div>
            <div class="input-box">
                <input type="password" name="farmer_password" placeholder="Farmer Password" required>
            </div>
            <div class="input-box">
                <textarea name="farmer_address" id="" cols="30"
                    style="width: 95%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; outline: none;"
                    rows="5" placeholder="Address"></textarea>
            </div>
            <div class="input-box">
                <div>Select favorite Color for hint? </div>
                <select name="farmer_hint" style="width: 100%;padding: 10px;">
                    <option value="">Select Color</option>
                    <option value="red" style="color:Red;">Red</option>
                    <option value="blue" style="color:Blue;">Blue</option>
                    <option value="green" style="color:Green;">Green</option>
                    <option value="yellow" style="color:Yellow;">Yellow</option>
                    <option value="orange" style="color:Orange;">Orange</option>
                </select>

            </div>
            <div style="display: flex;justify-content: space-between;">
                <input type="submit" value="Register" name="save_farmer" class="submit-btn">
                <a href="login.php"
                    style="cursor: pointer;margin-left: 10px; text-decoration: none; text-align: center; background-color: green;"
                    class="submit-btn">
                    Back
                </a>
            </div>

        </form>
    </div>
</body>

</html>