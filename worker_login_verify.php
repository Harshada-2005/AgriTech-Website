<?php
session_start();
include "admin/db/dbconnect.php";
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM tbl_worker WHERE head_username='$username' AND head_password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Fetch the row
    $_SESSION['head_username'] = $row['head_username']; // Assign username to session
    $_SESSION['head_id'] = $row['head_id']; // Assign username to session


    echo "<script>window.location = 'workerUpdate.php';</script>";
} else {

    header("Location: workerLogin.php?error=1");
}