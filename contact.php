<?php
include "header.php";
include "admin/db/dbconnect.php";
?>
<!-- full Title -->
<!-- full Title -->
<div class="full-title">
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Contact
            <small></small>
        </h1>
    </div>
</div>

<!-- Page Content -->
<div class="container">
    <div class="breadcrumb-main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Contact</li>
        </ol>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Map Column -->
        <div class="col-lg-8 mb-4 contact-left">
            <h3>Ask Any Query Here</h3>
            <form name="sentMessage" id="contactForm" method="post" action="sendmessage.php"
                enctype="multipart/form-data">
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Full Name</label>
                        <input type="text" class="form-control" id="name" value="<?= $_SESSION["farmer_fullname"] ?>"
                            disabled>
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Phone Number</label>
                        <input type="tel" class="form-control" id="phone"
                            value="<?= $_SESSION["farmer_mobilenumber"] ?>" disabled>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Email Address</label>
                        <input type="email" class="form-control" id="email" value="<?= $_SESSION["farmer_email"] ?>"
                            disabled>
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <input type="hidden" name="transaction_farmer" class="form-control" id="email"
                            value="<?= $_SESSION["farmer_id"] ?>">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label for="imageUpload">Choose Image(s) to Upload <span class="text-danger">*</span></label>
                        <input type="file" class="form-control-file" id="imageUpload" name="image[]" multiple
                            onchange="previewImages(event)">
                        <div id="imagePreview"></div> <!-- Image preview container -->
                    </div>
                </div>
                <div class="control-group form-group">
                    <label for="consultant_special">Consultant <span class="text-danger">*</span></label>
                    <select class="form-control" id="consultant_special" name="transaction_consultant">
                        <option value="">Select Service</option>
                        <?php
                        $sql = "SELECT * FROM tbl_consultants";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['consultant_id'] . "'>" . $row['consultant_full_name'] . "</option>";
                            }
                        } else {
                            echo "<option disabled>No special available</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="control-group form-group">
                    <div class="controls">
                        <label>Description <span class="text-danger">*</span></label>
                        <textarea rows="5" name="transaction_question" cols="100" class="form-control" id="message"
                            required data-validation-required-message="Please enter your message here" maxlength="999"
                            style="resize:none" placeholder="Enter your message here"></textarea>
                    </div>
                </div>
                <div id="success"></div>
                <!-- For success/fail messages -->
                <button type="submit" class="btn btn-primary" name="send" id="sendMessageButton">Send Message</button>
            </form>

        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4 contact-right">
            
            
               
        </div>
    </div>
    <!-- /.row -->
    <hr>
    <div class="row">
        <div class="container">
            <div class="row">
                <?php
                $sql = "SELECT *
                            FROM tbl_transaction
                            INNER JOIN tbl_farmer ON tbl_farmer.farmer_id = tbl_transaction.transaction_farmer
                            LEFT JOIN tbl_consultants ON tbl_consultants.consultant_id = tbl_transaction.transaction_consultant
                            WHERE transaction_status = 1 and transaction_farmer = ?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $_SESSION["farmer_id"]);
                $stmt->execute();
                $result = $stmt->get_result();

                foreach ($result as $value) :
                ?>
                <div class="col-md-6">
                    <div class="card border mb-3">
                        <div class="card-header  bg-secondary text-white">
                            Consultant: <span class="font-weight-bold"><?= $value['consultant_full_name'] ?></span>
                        </div>
                        <div class="card-body ">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <b>Images:</b>
                                    <div class="row mt-2">
                                        <?php if (isset($value['transaction_photo'])) :
                                                $images = unserialize($value['transaction_photo']);
                                                foreach ($images as $image) : ?>
                                        <div class="col-md-4 mb-3">
                                            <img src="<?= $image ?>" class="img-fluid" alt="Transaction Image">
                                        </div>
                                        <?php endforeach;
                                            endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <b>Query:</b>
                                    <p><?= $value["transaction_question"] ?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <?php if ($value["transaction_answer"] == "") : ?>
                                    <div class="text-info font-weight-bold">Pending</div>
                                    <?php else : ?>
                                    <div class="mb-3"><b class="">Reply:</b> <?= $value["transaction_answer"] ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


</div>
<!-- /.container -->

<script>
function previewImages(event) {
    var previewContainer = document.getElementById('imagePreview');
    previewContainer.innerHTML = ''; // Clear previous previews

    var files = event.target.files; // Get the selected files

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader(); // Create a FileReader object

        reader.onload = function(e) {
            var image = document.createElement('img'); // Create an img element
            image.src = e.target.result; // Set the image source to the FileReader result
            image.style.maxWidth = '100px'; // Set max width for preview image
            image.style.maxHeight = '100px'; // Set max height for preview image
            previewContainer.appendChild(image); // Append the image to the preview container
        };

        reader.readAsDataURL(file); // Read the file as a Data URL
    }
}
</script>

<?php
include "footer.php";
?>