<?php
session_start();
include "admin/db/dbconnect.php"; // Include your database connection file

// Check if user is logged in
if (!isset($_SESSION['head_id'])) {
    header("Location: workerLogin.php");
    exit();
}

// Get updated information from form
$worker_id = $_POST['head_id'];
$name = $_POST['head_name'];
$username = $_POST['head_username'];
$password = $_POST['head_password'];
$worker_count = $_POST['head_worker'];
$mobile = $_POST['head_mobile'];
$email = $_POST['head_email'];
$address = $_POST['head_address'];

$sql = "UPDATE tbl_worker SET head_name='$name', head_username='$username', head_password='$password', head_worker='$worker_count', head_mobile='$mobile', head_email='$email', head_address = '$address' WHERE head_id='$worker_id'";
if ($conn->query($sql) === TRUE) {
    $_SESSION["success"] = "Information Updated Successfully!";
    echo "<script>window.location='workerUpdate.php'</script>";
} else {
    echo "Error updating profile: " . $conn->error;
}

$conn->close();