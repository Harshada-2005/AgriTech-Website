<?php
include "header.php";
?>
<!-- full Title -->
<div class="full-title">
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Services
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
        <h1 class="my-4">Our Best Services </h1>
        <!-- Services Section -->
        <div class="row">

            <?php
            include "admin/db/dbconnect.php";
            $sql = "SELECT * FROM tbl_services where services_status = 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $count = 1;
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col-lg-4 mb-4">
                <a href="services_categories.php?services_id=<?= $row["services_id"] ?>" class="card h-100"
                    style="text-decoration: none;">
                    <h4 class="card-header"><?= $row["services_title"] ?></h4>
                    <div class="card-img">
                        <img height="300px" src="admin/<?= $row["services_image"] ?>"
                            alt="<?= $row["services_image"] ?>" />
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $row["services_description"] ?></p>
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
    <!-- Our Customers -->
    <div class="customers-box">
        <h2>Our Member's</h2>
        <div class="row">
            <?php
            $sqlquery = "SELECT * FROM tbl_farmer where farmer_status = 1";
            $resulted = $conn->query($sqlquery);
            foreach ($resulted as $item) {
            ?>
            <div class="col-lg-2 col-sm-4 mb-4 font-weight-bold text-center">
                <?= $item["farmer_fullname"] ?>
            </div>
            <?php
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