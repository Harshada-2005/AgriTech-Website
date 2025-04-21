<?php
session_start();
include "admin/db/dbconnect.php"; // Include your database connection file

if (isset($_POST['send'])) {
    // Extract form data
    $transaction_farmer = $_POST['transaction_farmer'];

    $transaction_consultant = $_POST['transaction_consultant'];
    $transaction_question = $_POST['transaction_question'];

    // Handle file uploads
    $filePaths = [];
    if (!empty($_FILES['image']['name'][0])) {
        $filesCount = count($_FILES['image']['name']);
        for ($i = 0; $i < $filesCount; $i++) {
            $fileName = $_FILES['image']['name'][$i];
            $fileTmpName = $_FILES['image']['tmp_name'][$i];
            $fileDestination = 'admin/uploads/messages/' . $fileName; // Specify your upload directory
            move_uploaded_file($fileTmpName, $fileDestination);
            $filePaths[] = $fileDestination; // Store file paths in an array
        }
    }

    // Prepare SQL statement
    $sql = "INSERT INTO tbl_transaction (transaction_farmer, transaction_consultant, transaction_question, transaction_photo) VALUES (?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("iiss", $transaction_farmer, $transaction_consultant, $transaction_question, serialize($filePaths));

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script> alert('Data Saved Successfully!') </script>";
        header("Location: contact.php");
    } else {
        // Error
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
}
