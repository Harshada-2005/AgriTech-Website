<?php
session_start();
include "./admin/db/dbconnect.php";
if (isset($_POST["forworker"])) {
    $wm_worker = $_POST['wm_worker'];
    $wm_member = $_POST['wm_member'];
    $wm_question = $_POST['wm_question'];

    // Prepare SQL statement
    $sql = "INSERT INTO worker_member (wm_worker, wm_member, wm_question) 
            VALUES ('$wm_worker', '$wm_member', '$wm_question')";
    $update_sql = "UPDATE tbl_worker SET head_status = 2 WHERE head_id = $wm_worker";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE && $conn->query($update_sql) === TRUE) {
        $_SESSION["success"] = "Message sent successfully";
        echo "<script>window.location='forwroker.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
