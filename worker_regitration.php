<?php
session_start();
include "admin/db/dbconnect.php";

// Retrieve form data
$head_name = $_POST['head_name'];
$head_username = $_POST['head_username'];
$head_password = $_POST['head_password']; // Hash the password (you should use more secure hashing methods)
$head_worker = $_POST['head_worker'];
$head_mobile = $_POST['head_mobile'];
$head_email = $_POST['head_email'];
$head_address = $_POST['head_address'];

// Check if the head_name already exists
$check_name_sql = "SELECT * FROM tbl_worker WHERE head_name = '$head_name'";
$check_name_result = $conn->query($check_name_sql);

if ($check_name_result->num_rows > 0) {
    // Worker with the same head_name already exists
    $_SESSION["fail"] = "Worker with the same name already exists!";
    header("Location: workerRegister.php"); // Redirect back to registration page
    exit(); // Terminate the script
}

// Check if the head_username already exists
$check_username_sql = "SELECT * FROM tbl_worker WHERE head_username = '$head_username'";
$check_username_result = $conn->query($check_username_sql);

if ($check_username_result->num_rows > 0) {
    // Worker with the same head_username already exists
    $_SESSION["fail"] = "Worker with the same username already exists!";
    header("Location: workerRegister.php"); // Redirect back to registration page
    exit(); // Terminate the script
}

// Insert data into tbl_worker table
$sql = "INSERT INTO tbl_worker (head_name, head_username, head_password, head_worker, head_mobile, head_email, head_address) VALUES ('$head_name', '$head_username', '$head_password', '$head_worker', '$head_mobile', '$head_email','$head_address')";

if ($conn->query($sql) === TRUE) {
    $_SESSION["success"] = "Registration Completed Successfully!";
    echo "<script>window.location = 'workerLogin.php'; </script>";
} else {
    $_SESSION["fail"] = "Failed to register the worker!";
    header("Location: workerRegister.php"); // Redirect back to registration page
}

$conn->close();