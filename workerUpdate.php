<?php
session_start();
include "admin/db/dbconnect.php"; // Include your database connection file

// Check if user is logged in
if (!isset($_SESSION['head_id'])) {
    header("Location: workerLogin.php");
    exit();
}

// Fetch worker's current information
$head_id = $_SESSION['head_id'];
$sql = "SELECT * FROM tbl_worker WHERE head_id='$head_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc(); // Fetch the worker's information

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="workerUpdateForm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="row" style="display: flex; justify-content: space-around;">
        <div class="   " style="width: 50%;padding: 30px;">
            <div style="display: flex; justify-content: space-between;">
                <div>
                    <h2>Update Worker Profile </h2>
                </div>
                <div>
                    <?php
                    $countQuery = "
              SELECT COUNT(*) AS worker_count
              FROM worker_member
              WHERE wm_worker = " . $_SESSION['head_id'] . "
              AND wm_status = 1";
                    $notifi = mysqli_query($conn, $countQuery);
                    $notification_count = 0;

                    if ($notifi) {
                        $ry = mysqli_fetch_assoc($notifi);
                        $notification_count = $ry['worker_count'];
                    }
                    ?>

                </div>
            </div>
            <div style="color: green; font-weight: bold;"><?= isset($_SESSION["success"]) ? $_SESSION["success"] : "" ?>
            </div>
            <form class="update-form" action="worker_update.php" method="post" onsubmit="return validateForm()">
                <input type="hidden" name="head_id" value="<?php echo $row['head_id']; ?>">
                <!-- Include worker ID as hidden field -->
                <input type="text" name="head_name" placeholder="Name" value="<?php echo $row['head_name']; ?>"
                    required>
                <input type="text" name="head_username" placeholder="Username"
                    value="<?php echo $row['head_username']; ?>" required>
                <input type="password" name="head_password" placeholder="Password"
                    value="<?php echo $row['head_username']; ?>" required>
                <input type="text" name="head_worker" placeholder="Total Worker"
                    value="<?php echo $row['head_worker']; ?>">
                <input type="text" name="head_mobile" placeholder="Mobile" maxlength="10"
                    value="<?php echo $row['head_mobile']; ?>" required>
                <input type="email" name="head_email" placeholder="Email" value="<?php echo $row['head_email']; ?>"
                    required>
                <input type="text" name="head_address" placeholder="Address" value="<?php echo $row['head_address']; ?>"
                    required>
                <input type="submit" value="Update">
                <a href="logout.php">

                    <input type="button" value="Logout">
                </a>
            </form>
        </div>
        <div class="" style="padding: 10px;width: 50%;">
            <div class="">
                <div class="card-body">
                    <?php

                    $sql = "SELECT * FROM worker_member inner join tbl_farmer on tbl_farmer.farmer_id = worker_member.wm_member  where wm_worker= $head_id";

                    // Execute the query
                    $result = $conn->query($sql);

                    // Check if there are any rows returned
                    if ($result->num_rows > 0) {
                        // Output HTML table structure
                        while ($row = $result->fetch_assoc()) {

                    ?>
                    <form action="workerMessage.php" method="post">

                        <h2>Message from <?= $row["farmer_fullname"] ?>:</h2>
                        <h3>

                            <?= $row["wm_question"] ?>
                        </h3>
                        <div style="color: green; font-weight: bold;">
                            <?= isset($_SESSION["responseError"]) ? $_SESSION["responseError"] : "" ?>
                        </div>
                        <input type="hidden" value="<?= $row["wm_id"] ?>" name="wm_id">
                        <input type="hidden" value="<?= $row["wm_worker"] ?>" name="wm_worker">
                        <div class="update-form" style="width: 30%;">
                            <?php if ($row["wm_response"] == null) { ?>
                            <textarea name="wm_response" id="" cols="30" rows="5"
                                placeholder="Write Your response"></textarea>
                            <?php
                                    } else {
                                        echo "<h3>Your Response:</h3>";
                                        echo "<h4 style='margin-left: 30px;'>
                                        " . $row["wm_response"] . "</h4>";
                                    }

                                    ?>

                            <div style="display: flex; ">
                                <?php if ($row["wm_response"] == null) { ?>
                                <input type="submit" name="submit" value="Send Response">
                                <?php
                                        }
                                        ?>
                                <input type="submit" name="clear" value="Clear Inbox"
                                    style="margin-left: 10px;background-color: blueviolet;">
                            </div>
                    </form>
                    <?php
                        }
                    } else {
                        // If no rows returned, display a message
                        echo "<div style='padding:30px'>No message comes yet !</div>";
                    }
                    ?>
                    <div style="color: green; font-weight: bold;">
                        <?= isset($_SESSION["inboxCleared"]) ? $_SESSION["inboxCleared"] : "" ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <script>
    function validateForm() {
        var name = document.getElementsByName("head_name")[0].value;
        var username = document.getElementsByName("head_username")[0].value;
        var password = document.getElementsByName("head_password")[0].value;
        var mobile = document.getElementsByName("head_mobile")[0].value;
        var email = document.getElementsByName("head_email")[0].value;

        if (name.trim() == "" || username.trim() == "" || password.trim() == "" || mobile.trim() == "" || email
            .trim() == "") {
            alert("All fields must be filled out");
            return false;
        }

        return true;
    }
    </script>
</body>

</html>
