<?php
include "admin/db/dbconnect.php";
?>
<!--footer starts from here-->
<footer class="footer">
    <div class="container bottom_border">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col">
                <h5 class="headin5_amrc col_white_amrc pt2">Find us</h5>
                <!--headin5_amrc-->
                <p class="mb10">Our flagship products include precision irrigation systems, soil sensors, and crop
                    monitoring software that enable farmers to monitor and manage their fields with unprecedented
                    accuracy.
                <p><i class="fa fa-phone"></i> +91-9999878398 </p>
                <p><i class="fa fa fa-envelope"></i> info@example.com </p>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col">
                <h5 class="headin5_amrc col_white_amrc pt2">Follow us</h5>
                <!--headin5_amrc ends here-->
                <ul class="footer_ul2_amrc">
                    <li>
                        <a href="#"><i class="fab fa-instagram fleft padding-right"></i> </a>
                        <p>Instagram ...<a href="#">https://www.lipsum.com/</a></p>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-facebook fleft padding-right"></i> </a>
                        <p>Facebook ...<a href="#">https://www.lipsum.com/</a></p>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-whatsapp fleft padding-right"></i> </a>
                        <p>Whatsapp ...<a href="#">https://www.lipsum.com/</a></p>
                    </li>
                    <li>
                        <a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a>
                        <p>Twitter <br> ...<a href="#">https://www.lipsum.com/</a></p>
                    </li>
                </ul>
                <!--footer_ul2_amrc ends here-->
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <h5 class="headin5_amrc col_white_amrc pt2">Quick links</h5>
                <!--headin5_amrc-->
                <ul class="footer_ul_amrc">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="services.php">Our Services</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="updateprofile.php">Update Profile</a></li>
                </ul>
                <!--footer_ul_amrc ends here-->
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 ">
                <h5 class="headin5_amrc col_white_amrc pt2">Recent Services</h5>
                <!--headin5_amrc-->
                <ul class="footer_ul_amrc">

                    <?php
                    $sql = "select * from tbl_services where services_status = 1";
                    $row = mysqli_query($conn, $sql);
                    $count = 0;
                    foreach ($row as $item) {
                        $count++;


                        if ($count > 3) {
                            break;
                        }
                    ?>
                        <li class="media">
                            <div class="media-left">
                                <img class="img-fluid" src="admin/<?= $item["services_image"] ?>" height="100px" width="100px" alt="" />
                            </div>
                            <div class="media-body">
                                <p><?= $item["services_title"] ?></p>
                                <span><?= $item["services_created_at"] ?></span>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <!--footer_ul_amrc ends here-->
            </div>
        </div>
    </div>
    <div class="container">
        <!-- <div class="footer-logo">
            <a href="#"><img src="images/footer-logo.png" alt="" /></a>
        </div> -->
        <!--foote_bottom_ul_amrc ends here-->
        <!-- <p class="copyright text-center">All Rights Reserved. &copy; 2024 <a href="#">N & LW Lawn Care</a> Design By
            :
            <a href="https://html.design/">html design</a>
        </p> -->
        <ul class="social_footer_ul">
            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul>
        <!--social_footer_ul ends here-->
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>