<?php
require './admin/db_connect.php';
$sql = "SELECT * FROM addedblogs ORDER BY created_at DESC LIMIT 2";
$result3 = $conn->query($sql);
$base_url = "";
?>

<footer class="footer-area">
    <div class="widget-area style1  pt-100 pb-80">
        <div class="container">
            <div class="footer-layout style1">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="widget footer-widget wow fadeInUp" data-wow-delay=".6s">
                            <div class="gt-widget-about">
                                <div class="about-logo">
                                    <a href="index.php"><img src="assets/img/webimg/apricron.png" alt="logo-img" style="width: 120px; height: 50px;"></a>
                                </div>
                                <p class="about-text"> Apricorn Solution Technology is an information technology company specializing in providing innovative and tailored IT solutions to meet the diverse needs of businesses.
                                </p>
                                <div class="gt-social style2">
                                    <a href="https://www.facebook.com/ApricornSolutions/"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://x.com/apricornsol"><i class="fab fa-twitter"></i></a>
                                    <a href="https://www.linkedin.com/company/apricorn-solutions/"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://www.instagram.com/apricorn_solutions/"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-12">
                        <div class="widget widget_nav_menu footer-widget wow fadeInUp" data-wow-delay="1s">
                            <h3 class="widget_title">Quick Links</h3>
                            <div class="menu-all-pages-container">
                                <ul class="menu">
                                    <li><a href="about"><i class="fa-solid fa-chevrons-right"></i> About us</a>
                                    </li>
                                    <li><a href="service"><i class="fa-solid fa-chevrons-right"></i>Our Services</a>
                                    </li>
                                    <li><a href="blog"><i class="fa-solid fa-chevrons-right"></i>Our
                                            Blogs</a>
                                    </li>
                                    <li><a href="contactus"><i class="fa-solid fa-chevrons-right"></i>Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="widget footer-widget wow fadeInUp" data-wow-delay="1.3s">
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">
                                <?php
                                if ($result3->num_rows > 0) {
                                    while ($row = $result3->fetch_assoc()) {
                                ?>
                                        <div class="recent-post">
                                            <div class="media-img">
                                                <a href="blogdetails?slug=<?php echo urlencode($row['slug']); ?>">
                                                    <img src="<?php echo $base_url . 'admin/uploads/' . $row['image']; ?>" alt="thumb">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="recent-post-meta">
                                                   
                                                    <a href="blogdetails?slug=<?php echo urlencode($row['slug']); ?>">
                                                        <img src="assets/img/icon/calendarIcon.svg" alt="icon"><?php echo date("jS F, Y", strtotime($row['created_at'])); ?>
                                                    </a>
                                                </div>
                                                <h4 class="post-title">
                                                    <a class="text-inherit" href="blogdetails?slug=<?php echo urlencode($row['slug']); ?>"><?php echo $row['title']; ?></a>
                                                </h4>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="widget widget_nav_menu footer-widget wow fadeInUp" data-wow-delay="1.6s">
                            <h3 class="widget_title">Contact Us</h3>
                            <div class="checklist style2">
                                <ul class="ps-0">
                                    <li class="text-white"><i class="fa-solid fa-envelope"></i></li>
                                    <li class="text-white">info@apricornsolutions.com</li>
                                </ul>
                                <ul class="ps-0">
                                    <li class="text-white"><i class="fa-solid fa-phone"></i></li>
                                    <li class="text-white">+919991538679</li>
                                </ul>
                                <div class="email-input-container">
                                    <input type="email" id="email" placeholder="Your email address" required="">
                                    <button type="submit" id="submitButton" disabled=""><i
                                            class="fa-regular fa-arrow-right-long"></i></button>
                                </div>
                                <form id="termsForm">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="agree" id="agreeCheckbox">
                                        <span class="checkmark"></span>
                                        I agree to the <a class="text-underline" href="contactus.php" target="_blank">Privacy
                                            Policy.</a>
                                    </label>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap bg-theme">
        <div class="container">
            <div class="copyright-layout">
                <div class="layout-text wow fadeInUp" data-wow-delay=".3s">
                    <p class="copyright">
                        <i class="fal fa-copyright"></i> All Copyright 2025 by <a href="/">apricornsolutions</a>
                    </p>
                </div>
                <div class="layout-link wow fadeInUp" data-wow-delay=".6s">
                    <div class="link-wrapper">
                        <a href="terms&condition">Terms &amp; Condition </a>
                        <a href="privacy-policy">Privacy Policy</a>
                        <a href="https://apricornsolutions.com/sitemap.xml">Site Map</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

 
<!--<< All JS Plugins >>-->
<script src="assets/js/jquery-3.7.1.min.js"></script>
<!--<< Viewport Js >>-->
<script src="assets/js/viewport.jquery.js"></script>
<!--<< Bootstrap Js >>-->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--<< Nice Select Js >>-->
<script src="assets/js/jquery.nice-select.min.js"></script>
<!--<< Waypoints Js >>-->
<script src="assets/js/jquery.waypoints.js"></script>
<!--<< Counterup Js >>-->
<script src="assets/js/jquery.counterup.min.js"></script>
<!--<< Swiper Slider Js >>-->
<script src="assets/js/swiper-bundle.min.js"></script>
<!--<< MeanMenu Js >>-->
<script src="assets/js/jquery.meanmenu.min.js"></script>
<!--<< Magnific Popup Js >>-->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!--<< Wow Animation Js >>-->
<script src="assets/js/wow.min.js"></script>
<!--<< Main.js >>-->
<script src="assets/js/main.js"></script>

</body>

</html>