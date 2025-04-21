<?php
include "header.php";
?>
<!-- full Title -->
<div class="full-title">
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">About
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
            <li class="breadcrumb-item active">About</li>
        </ol>
    </div>
    <!-- About Content -->
    <div class="about-main">
        <div class="row">
            <div class="col-lg-6">
                <img class="img-fluid rounded mb-4" src="images/about-img.jpg" alt="" />
            </div>
            <div class="col-lg-6">
                <h2>About Modern Business</h2>
                <p>We're always eager to connect with farmers, investors, and collaborators who share our passion for
                    transforming agriculture. Whether you have questions, feedback, or partnership opportunities, don't
                    hesitate to reach out to us.
                </p>
                <p>Using a combination of advanced sensors, artificial intelligence, and predictive analytics, we
                    provide farmers with real-time monitoring and actionable recommendations tailored to their specific
                    needs. From soil health analysis to crop disease detection, we offer a comprehensive suite of tools
                    designed to improve decision-making and maximize harvests.</p>
                <p>Innovation: We continually push the boundaries of agricultural technology to deliver groundbreaking
                    solutions that drive progress and sustainability.
                    Impact: Our ultimate goal is to make a positive impact on the lives of farmers and communities by
                    enabling more efficient and sustainable farming practices.</p>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Team Members -->
    <div class="team-members-box">
        <h2>Our Consultant's</h2>
        <div class="row">
            <?php
            include "admin/db/dbconnect.php";
            $sql = "SELECT * FROM tbl_consultants inner join tbl_special on tbl_special.special_id = tbl_consultants.consultant_special where special_status = 1";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $count = 1;
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100 text-center">
                            <div class="card-header ">
                                <div class=" ">

                                    Specialist in <?= $row["special_name"] ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?= $row["consultant_full_name"] ?></h4>
                                <h6 class="card-subtitle mb-2 text-muted"><?= $row["consultant_phone_number"] ?></h6>
                                <p class="card-text"><?= $row["consultant_address"] ?></p>
                            </div>
                            <div class="card-footer bg-light">
                                <div class="">
                                    <div>Email: <?= $row["consultant_email"] ?></div>
                                </div>
                            </div>
                        </div>
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
                <div class="col-lg-2 col-sm-4 mb-4 font-weight-bold  text-center">
                    <?= $item["farmer_fullname"] ?>
                </div>
            <?php
            }
            ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<?php
include "footer.php";
?>