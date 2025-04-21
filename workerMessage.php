<?php
session_start();
include "admin/db/dbconnect.php"; // Include your database connection file

// Check if wm_id is submitted via POST
if (isset($_POST['clear'])) {
    $wm_id = $_POST['wm_id'];
    $wm_worker = $_POST['wm_worker'];

    $sql = "DELETE FROM worker_member WHERE wm_id = $wm_id";

    $update_sql = "UPDATE tbl_worker SET head_status = 1 WHERE head_id = $wm_worker";
    if ($conn->query($sql) === TRUE && $conn->query($update_sql) === TRUE) {
        $_SESSION["inboxCleared"] = "Inbox cleared !";
        header("Location: workerUpdate.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}


if (isset($_POST["submit"])) {
    $wm_id = $_POST['wm_id'];
    $wm_response = $_POST["wm_response"];

    $updateResponse = "UPDATE worker_member SET wm_response = '$wm_response' WHERE wm_id = $wm_id";

    if ($wm_response) {
        if ($conn->query($updateResponse) === TRUE) {
            $_SESSION["responseError"] = "Response submittted!";
            header("Location: workerUpdate.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        $_SESSION["responseError"] = "Enter response before submitting !";
        header("Location: workerUpdate.php");
        exit();
    }
}
// Close the database connection
$conn->close();
