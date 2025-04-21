<?php
include "header.php";
$services_id = $_GET["services_id"];
?>
<!-- full Title -->
<div class="full-title">
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Categories
            <small>We provide a comprehensive range of services tailored to meet your needs, ensuring efficiency,
                reliability, and satisfaction.</small>
        </h1>
    </div>
</div>

<!-- Page Content -->
<div class="container">
    <!-- <div class="breadcrumb-main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Services</li>
        </ol>
    </div> -->

    <!-- Image Header -->
    <!-- <img class="img-fluid rounded mb-4" src="images/services-big.jpg" alt="" /> -->

    <!-- Services Section -->
    <div class="services-bar">
        <div class="d-flex justify-content-between my-4">
            <h1 class="">Categories</h1>
            <a href="services.php" class="btn btn-success text-white">All Services</a>
        </div>
        <!-- Services Section -->
        <div class="row">

            <?php
            include "admin/db/dbconnect.php";
            $sql = "SELECT * FROM tbl_categories inner join tbl_services on tbl_categories.categories_services = tbl_services.services_id where categories_status = 1 and categories_services = $services_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $count = 1;
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col-lg-3 mb-4">
                        <a href="categories_view.php?categories_id=<?= $row["categories_id"] ?>" class="card h-100" style="text-decoration: none;">
                            <h4 class="card-header"><?= $row["categories_title"] ?></h4>
                            <div class="card-img">
                                <img class="" height="300px" src="admin/<?= $row["categories_image"] ?>" alt="<?= $row["services_image"] ?>" />
                            </div>
                            <div class="card-body bg-light">
                                <p class="card-text"><?= $row["categories_description"] ?></p>
                            </div>

                        </a>
                    </div>
            <?php
                }
            }
            ?>

        </div>
        <!-- /.row -->
    </div>


</div>
<!-- /.container -->
<?php
include "footer.php";
?>