<?php
session_start();
include "admin/db/dbconnect.php";
if (isset($_POST["login"])) {
    $username = $_POST["email"];
    $password = $_POST["password"];
    $userType = $_POST["userType"];

    if ($userType == 1) {
        $stmt = $conn->prepare("SELECT * FROM tbl_farmer WHERE farmer_email = ? AND farmer_password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["farmer_id"] = $row['farmer_id'];
            $_SESSION["farmer_fullname"] = $row['farmer_fullname'];
            $_SESSION["farmer_address"] = $row['farmer_address'];
            $_SESSION["farmer_mobilenumber"] = $row['farmer_mobilenumber'];
            $_SESSION["farmer_email"] = $row['farmer_email'];
            $_SESSION["farmer_status"] = $row['farmer_status'];
            $_SESSION["farmer_password"] = $row['farmer_password'];
            header("Location: index.php");
        } else {
            $_SESSION['fail'] = "Check Username and Password!";
            header("Location: login.php");
        }
    } else {

        $stmt = $conn->prepare("SELECT * FROM tbl_consultants WHERE consultant_email = ? AND consultant_password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["consultant_id"] = $row['consultant_id'];
            $_SESSION["consultant_full_name"] = $row['consultant_full_name'];
            $_SESSION["consultant_email"] = $row['consultant_email'];
            $_SESSION["consultant_phone_number"] = $row['consultant_phone_number'];
            $_SESSION["consultant_a ddress"] = $row['consultant_address'];
            $_SESSION["consultant_special"] = $row['consultant_special'];
            $_SESSION["consultant_status"] = $row['consultant_status'];
            $_SESSION["consultant_password"] = $row['consultant_password'];
            $_SESSION["created_at"] = $row['created_at'];
            header("Location: admin/index.php");
        } else {
            $_SESSION['fail'] = "Check Username and Password!";
            header("Location: login.php");
        }
    }
}