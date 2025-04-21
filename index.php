<?php
include "header.php";
?>
<header class="slider-main">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <!-- Slide One - Set the background image for this slide in the line below -->
            <div class="carousel-item active" style="background-image: url('images/slider-01.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Welcome to Agri Tech</h3>
                    <p>Agri Tech</p>
                </div>
            </div>
            <!-- Slide Two - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('images/slider-02.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Beautiful Garden</h3>
                    <p>Agri Tech</p>
                </div>
            </div>
            <!-- Slide Three - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('images/slider-03.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Welcome to Agri Tech</h3>
                    <p>Agri Tech</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>
<div class="container">
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
                        <a href="services_categories.php?services_id=<?= $row["services_id"] ?>" class="card h-100" style="text-decoration: none;">
                            <h4 class="card-header"><?= $row["services_title"] ?></h4>
                            <div class="card-img">
                                <img height="300px" src="admin/<?= $row["services_image"] ?>" alt="<?= $row["services_image"] ?>" />
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
    <!-- About Section -->
    <div class="about-main">
        <div class="row">
            <div class="col-lg-6">
                <h2>Welcome to Agri Tech</h2>
                <p>We believe in working closely with farmers, researchers, and industry partners to co-create solutions
                    that address real-world challenges.</p>
                <h5>Our smart approach</h5>
                <ul>
                    <li>Precision Agriculture: We employ precision farming techniques to precisely manage inputs such as
                        water, fertilizers, and pesticides, optimizing their use and reducing waste.</li>
                    <li>Data-Driven Insights: Our smart farming solutions collect and analyze data from various sources,
                        providing farmers with actionable insights to make informed decisions and improve productivity.
                    </li>
                    <li>Remote Monitoring: Through remote sensing and IoT devices, farmers can monitor field conditions,
                        crop health, and equipment performance from anywhere, allowing for timely interventions and
                        proactive management.</li>
                    <li>Sustainability Focus: We prioritize sustainable farming practices by promoting soil health,
                        biodiversity, and resource conservation, ensuring long-term viability for both farmers and the
                        environment.</li>
                </ul>


            </div>
            <div class="col-lg-6">
                <img class="img-fluid rounded" src="images/about-img.jpg" alt="" />
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- Portfolio Section -->
    <div class="portfolio-main">
        <h2>Our Portfolio</h2>
        <div class="row">
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-img">
                        <div class="text-white">
                            <img class="card-img-top" src="images/portfolio-img-01.jpg" alt="" />

                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <div class="text-white">Lawn & garden care</div>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-img">
                        <div class="text-white">
                            <img class="card-img-top" src="images/portfolio-img-02.jpg" alt="" />

                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <div class="text-white">Lawn renovation</div>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-img">
                        <div class="text-white">
                            <img class="card-img-top" src="images/portfolio-img-03.jpg" alt="" />

                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <div class="text-white">Tree planting</div>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-img">
                        <div class="text-white">
                            <img class="card-img-top" src="images/portfolio-img-04.jpg" alt="" />

                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <div class="text-white">Water Baganig</div>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-img">
                        <div class="text-white">
                            <img class="card-img-top" src="images/portfolio-img-05.jpg" alt="" />

                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <div class="text-white">Growing plants</div>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-img">
                        <div class="text-white">
                            <img class="card-img-top" src="images/portfolio-img-01.jpg" alt="" />

                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">
                            <div class="text-white">Snow removal</div>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>

</div>
<!-- /.container -->

<?php
include "footer.php";
?>