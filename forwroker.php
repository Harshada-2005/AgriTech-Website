<?php
include "header.php";
?>
<style>
.card {
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-title {
    color: #333;
}

.card-text {
    color: #666;
}
</style>
<div class="full-title ">
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Worker Section

        </h1>
    </div>
</div>
<div class="container ">
    <h2 class="m-3">Worker Details</h2>
    <h6 class="text-success m-3"><?php

                                    if (isset($_SESSION["success"])) {
                                        echo $_SESSION["success"];
                                    }
                                    unset($_SESSION["success"]);
                                    ?></h6>
    <div class="row">
        <?php
        include "./admin/db/dbconnect.php";
        $farmer_id = $_SESSION["farmer_id"];
        $sql = "SELECT * FROM `tbl_worker`  Left JOIN worker_member ON tbl_worker.head_id = worker_member.wm_worker;";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="title"><?php echo $row["head_name"]; ?></h5>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Contact Details</h6>
                    <p class="card-text text-center">Mobile: <?php echo $row["head_mobile"]; ?></p>
                    <p class="card-text text-center">Email: <?php echo $row["head_email"]; ?></p>

                    <h6 class="card-title">Address</h6>

                    <p class="card-text text-center"><?php echo $row["head_address"]; ?></p>
                    <h6 class="card-title">Total Worker's ( <?= $row["head_worker"] ?> )</h6>

                    <p class="text-center"> <?php
                                                    for ($i = 0; $i < $row["head_worker"]; $i++) {
                                                        echo ' <i class="fas fa-user"></i>   ';
                                                    }  ?></p>
                    <?php
                           if($row["wm_response"]!=null){
                           ?>
                    <h6 class="card-title">Reponse :</h6>

                    <p class="text-center"> <?php echo $row["wm_response"]; ?></p>
                    <?php
                           }
?>
                </div>
                <div class="card-footer ">
                    <form action="for_worker.php" method="post">
                        <?php
                                if ($row["head_status"] == 1) {

                                ?>
                        <div class="control-group form-group">
                            <input type="hidden" value="<?= $row['head_id'] ?>" name="wm_worker">
                            <input type="hidden" value="<?= $_SESSION['farmer_id'] ?>" name="wm_member">
                            <div class="controls ">
                                <textarea name="wm_question" id="" cols="30" rows="3" class="form-control"
                                    placeholder="Message"></textarea>
                            </div>
                        </div>

                        <button type="submit" name="forworker" class="btn btn-info w-100 ">
                            <div class="d-flex justify-content-between">
                                <div>Send Message</div>
                                <div>
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                        </button>
                        <?php
                                    // } else if ($row["head_status"] == 2) {
                                    ?>
                        <!-- <button type="button" class="btn btn-warning w-100 ">Wait For Response</button> -->
                        <?php

                                } else {
                                ?>
                        <button type="button" class="btn btn-danger w-100 ">Not Available Now</button>
                        <?php
                                }
                                ?>
                    </form>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "0 results";
        }
        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</div>
<?php
include "footer.php";
?>