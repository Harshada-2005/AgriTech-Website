<?php
include "header.php";
$categories_id = $_GET["categories_id"];
include "admin/db/dbconnect.php";
$sql = "SELECT * FROM tbl_categories inner join tbl_services on tbl_categories.categories_services = tbl_services.services_id where categories_id = $categories_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>
<!-- full Title -->
<div class="full-title">
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3"><?= $row["services_title"] ?>
            <small>
                <?= $row["services_description"] ?>
            </small>
        </h1>
    </div>
</div>

<!-- Page Content -->
<div class="container">

    <div class="card m-2">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="h3 font-weight-bold">
                    <?= $row["categories_title"] ?>
                </div>
                <div class="">
                    <a href="services_categories.php?services_id=<?= $row["services_id"] ?>" class="btn btn-success text-white">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body ">
            <div class="row">

                <div class="col-md-6">
                    <img src="admin/<?= $row["categories_image"] ?>" alt="" height="400px" width="500px">
                </div>
                <div class="col-md-6">
                    <p class="font-weight-bold">Description:</p>
                    <?= $row["categories_description"] ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container -->
<?php
include "footer.php";
?>