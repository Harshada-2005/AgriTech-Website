<?php
include "header.php";
include "admin/db/dbconnect.php";
if (isset($_SESSION["farmer_id"])) {
    $farmer_id = $_SESSION["farmer_id"];

    $sql = "SELECT * FROM tbl_farmer WHERE farmer_id = $farmer_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $farmer_full_name = $row['farmer_fullname'];
        $farmer_email = $row['farmer_email'];
        $farmer_phone_number = $row['farmer_mobilenumber'];
        $farmer_address = $row['farmer_address'];
        $farmer_password = $row['farmer_password'];
    } else {
        $_SESSION['fail'] = "Farmer not found.";
        echo "<script>window.location.href = 'farmer-index.php'; </script>";
    }
} else {
    $_SESSION['fail'] = "Farmer ID is missing.";
    echo "<script>window.location.href = 'farmer-index.php'; </script>";
}

if (isset($_POST["update"])) {
    $farmer_id = $_POST['farmer_id'];
    $farmer_full_name = $_POST['farmer_fullname'];
    $farmer_email = $_POST['farmer_email'];
    $farmer_phone_number = $_POST['farmer_mobilenumber'];
    $farmer_address = $_POST['farmer_address'];
    $farmer_password = $_POST['farmer_password'];

    // Update query
    $sql = "UPDATE tbl_farmer SET 
            farmer_fullname = '$farmer_full_name',
            farmer_email = '$farmer_email',
            farmer_mobilenumber = '$farmer_phone_number',
            farmer_address = '$farmer_address'
            WHERE farmer_id = $farmer_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Set success message and redirect
        $_SESSION['success'] = "Farmer information updated successfully.";
        echo "<script>window.location.href = 'updateprofile.php'; </script>";
    } else {
        // Set error message if query fails
        $_SESSION['fail'] = "Error updating farmer information: " . $conn->error;
        echo "<script>window.location.href = 'updateprofile.php'; </script>";
    }
}
?>
<div class="full-title">
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Update Profile</h1>
    </div>
</div>
<div class="container">
    <div class="card shadow m-3 p-4">

        <div class="card-body">
            <?php
            if (isset($_SESSION['fail'])) {
            ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Warning!</h5>
                    <?php echo $_SESSION['fail']; ?>
                </div>
            <?php
                unset($_SESSION['fail']);
            }
            ?>
            <?php
            if (isset($_SESSION['success'])) {
            ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Success!</h5>
                    <?php echo $_SESSION['success']; ?>
                </div>
            <?php
                unset($_SESSION['success']);
            }
            ?>
            <form action="" method="POST">
                <div class="row">
                    <!-- Populate form fields with existing farmer data -->
                    <div class="form-group col-md-6">
                        <label for="farmer_fullname">Full Name</label>
                        <input type="text" class="form-control" id="farmer_fullname" name="farmer_fullname" value="<?php echo $farmer_full_name; ?>" placeholder="Full Name">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="farmer_email">Email</label>
                        <input type="email" class="form-control" id="farmer_email" name="farmer_email" value="<?php echo $farmer_email; ?>" placeholder="Email">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="farmer_phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="farmer_phone_number" name="farmer_mobilenumber" value="<?php echo $farmer_phone_number; ?>" placeholder="Phone Number">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="farmer_phone_number">Password</label>
                        <input type="text" class="form-control" id="farmer_password" name="farmer_password" value="<?php echo $farmer_password; ?>" placeholder="Phone Number">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="farmer_address">Address</label>
                        <textarea name="farmer_address" id="farmer_address" cols="30" rows="5" class="form-control"><?php echo $farmer_address; ?></textarea>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <input type="hidden" name="farmer_id" value="<?php echo $farmer_id; ?>">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "footer.php"
?>