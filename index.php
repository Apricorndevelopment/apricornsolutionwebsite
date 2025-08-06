<?php
include "./admin/db_connect.php";
// echo "Connected successfully!";



// Fetch data from 'addedblogs' table
$result = $conn->query("SELECT * FROM addedblogs ORDER BY created_at DESC");

// if ($result) {
//     while ($row = $result->fetch_assoc()) {
//         // Output each row (customize as per your need)
//         echo "<p>" . $row['title'] . " - " . $row['content'] . "</p>";
//     }
// } else {
//     echo "Error: " . $conn->error;
// }

$conn->close();
?>

<head>
   <!-- ========== Meta Tags ========== -->
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="author" content="Yash Apricorn">
   <meta name="description" content="Get reliable website development and result-driven digital marketing services in India. We help you grow your online presence.">
   <link rel="canonical" href="https://apricornsolutions.com/" />
   <meta name="keywords" content="Digital marketing service in India, Website designing service in India, Seo Services service in India, Social media marketing service in India, PPC service in India, Search engine marketing service in India,">
   <!-- ======== Page title ============ -->
   <title>Trustable Website and Digital Marketing Service in India </title>

   <head>
      <!-- Open Graph meta tags -->
      <meta property="og:title" content="Apricorn Solutions - Digital Marketing & Web Development" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="https://apricornsolutions.com/" />
      <meta property="og:image" content="https://apricornsolutions.com/image1.jpg" />
      <meta property="og:description" content="Apricorn Solutions provides expert digital marketing, PPC, SEO, website development, and social media management services to help businesses grow online." />
      <meta property="og:site_name" content="Apricorn Solutions" />
      <meta property="og:locale" content="en_US" />

      <!-- Twitter Card meta tags -->
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:title" content="Apricorn Solutions - Digital Marketing & Web Development" />
      <meta name="twitter:description" content="Apricorn Solutions offers top-notch digital marketing and web development services to enhance your online presence." />
      <meta name="twitter:image" content="https://apricornsolutions.com/image1.jpg" />
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
/* Modal Customization */
.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    background: #f9f9f9;
}

.modal-header {
    background-color: #1a73e8;
    color: #fff;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.modal-title {
    font-weight: 600;
    font-size: 1.4rem;
}

.modal-body {
    padding: 20px 25px;
}

.modal-body label {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
    display: block;
    font-size: 0.95rem;
}

.modal-body .form-control {
    border-radius: 8px;
    border: 1px solid #ccc;
    padding: 12px 15px;
    font-size: 0.95rem;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.modal-body .form-control:focus {
    border-color: #1a73e8;
    box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
}

textarea.form-control {
    resize: none;
    min-height: 100px;
}

/* Submit Button */
.modal-footer .btn-success {
    background-color: #1a73e8;
    border-radius: 30px;
    padding: 10px 25px;
    font-weight: 600;
    border: none;
    transition: background 0.3s ease;
}

.modal-footer .btn-success:hover {
    background-color: #155ab6;
}

/* Responsive */
@media (max-width: 576px) {
    .modal-body {
        padding: 15px 20px;
    }

    .modal-footer .btn-success {
        width: 100%;
    }
}
</style>

   </head>


   <meta name="google-site-verification" content="7UQ94K3oqxO6bMo7-49A4TKS9-fhi6bJozDjApi-bPU" />
   <!-- Google tag (gtag.js) -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-DJTB4TLFW0"></script>
   <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
         dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'G-DJTB4TLFW0');
   </script>
   <!-- header Area   S T A R T -->
   <?php
   include 'header.php';
   ?>
   

<!--model box-->
<div class="modal fade" id="connectModal" tabindex="-1" aria-labelledby="connectModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="connectForm" method="post" action="connect_submit.php"> <!-- Use correct action -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Connect With Us</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
              <label>Name</label>
              <input type="text" name="name" class="form-control" style="color: black;" required>
            </div>
            <div class="mb-3">
              <label>Address</label>
              <input type="text" name="address" class="form-control" style="color: black;" required>
            </div>
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" style="color: black;" required>
            </div>
            <div class="mb-3">
              <label>Contact</label>
              <input type="text" name="contact" class="form-control" style="color: black;" required>
            </div>
            <div class="mb-3">
              <label>Enquiry</label>
              <textarea name="enquiry" class="form-control" style="color: black;" required></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>




   <!-- Hero Section    S T A R T -->
   <section class="hero-section fix">
      <div class="hero-wrapper style1" style="background:none;">
         <div class="shape1_2 d-none d-xxl-block"><img src="assets/img/shape/heroShape1_2.png" alt="development services in India"></div>
         <div class="shape1_3">
            <a href="contactus.php"> <img class="rotate360" src="assets/img/shape/heroShape1_3.png" alt="web development services in India"> </a>
         </div>
         <div class="shape1_4 movingX d-none d-xxl-block"><img src="assets/img/shape/heroShape1_4.png" alt="app development services in India">
         </div>
         <div class="shape1_5 float-bob-y d-none d-xxl-block"><img src="assets/img/shape/heroShape1_5.png" alt="software development services in India">
         </div>
         <div class="container">

            <div class="hero-main-container style1 border-radius" style="padding-top: 50px; background-color: #f9faff; font-family: 'Segoe UI', sans-serif;">
   <div class="container">
      <div class="row d-flex flex-wrap align-items-center align-items-xl-start">
         <!-- Left Content -->
         <div class="order-1 col-xl-6 order-xl-1">
            <div class="hero-content style1">
               <h6 class="subtitle" style="font-size: 16px; font-weight: 600; color: #1a73e8; display: flex; align-items: center; gap: 2px">
                  <img src="assets/img/icon/heart-beat.png" alt="digital services in India" style="width: 40px; height: 30px;" >
                  We are Website and Advertisement Expert
               </h6>

              <h1 style="font-size: 58px; line-height: 1.2; font-weight: 800; color: #0f0f0f; margin-top: 20px;" class="fs-md-5">
                Boost your revenue 5x in just 3 months with our <span style="color: #00bfff;">driven </span><span style="color: #007bff">marketing</span>
                </h1>


               <div class="checklist-wrapper style3" style="margin-top: 25px;">
                  <ul class="checklist style3" style="list-style: none; padding-left: 0;">
                     <li style="font-size: 16px; color: #333; margin-bottom: 10px;">
                        <img src="assets/img/icon/checkmarkIcon.svg" alt="icon" style="margin-right: 8px;"> 5x Revenue Growth
                     </li>
                     <li style="font-size: 16px; color: #333; margin-bottom: 10px;">
                        <img src="assets/img/icon/checkmarkIcon.svg" alt="icon" style="margin-right: 8px;"> Content-Driven Marketing
                     </li>
                  </ul>
                  <ul class="checklist style3" style="list-style: none; padding-left: 0;">
                     <li style="font-size: 16px; color: #333; margin-bottom: 10px;">
                        <img src="assets/img/icon/checkmarkIcon.svg" alt="icon" style="margin-right: 8px;"> Strategic Approach
                     </li>
                     <li style="font-size: 16px; color: #333;">
                        <img src="assets/img/icon/checkmarkIcon.svg" alt="icon" style="margin-right: 8px;"> Results in 3 Months
                     </li>
                  </ul>
               </div>

               <div class="contact-meta" style="margin-top: 30px;">
                  <div class="btn-wrapper">
                     <!--<a href="" class="gt-btn style4" style="background-color: #1a73e8; padding: 12px 24px; border-radius: 30px; color: white; font-weight: 600; text-decoration: none;">-->
                     <!--   Connect Us <i class="fa-sharp fa-regular fa-arrow-right-long" style="margin-left: 8px;"></i>-->
                     <!--</a>-->
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#connectModal" style="padding: 12px 24px; border-radius: 30px; font-weight: 600;">
      Connect Us <i class="fa fa-arrow-right" style="margin-left: 8px;"></i>
   </a>

                  </div>
               </div>

               <div class="fancy-box-wrapper style5 wow fadeInUp" data-wow-delay=".5s" style="margin-top: 40px;">
                  <div class="fancy-box style5" style="background: #ffffff; padding: 20px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 20px;">
                     <div class="title" style="font-weight: 600; color: #0f0f0f; margin-bottom: 12px;">
                        <img src="assets/img/icon/starIcon1_1.svg" alt="icon" style="margin-right: 6px;"> Happy Client
                     </div>
                     <div class="item-wrap" style="display: flex; align-items: center; gap: 12px;">
                        <div class="item">
                           <img src="assets/img/shape/profileShape1_1.png" alt="online services in India" style="width: 48px;">
                        </div>
                        <div class="item">
                           <div class="star-wrapper">
                              <img src="assets/img/icon/starIcon1_2.svg" alt="icon">
                              <img src="assets/img/icon/starIcon1_2.svg" alt="icon">
                              <img src="assets/img/icon/starIcon1_2.svg" alt="icon">
                           </div>
                           <h6 style="font-weight: bold; font-size: 16px; margin-top: 5px;">200+</h6>
                        </div>
                     </div>
                  </div>

                  <div class="border-0 fancy-box style5" style="background: #ffffff; padding: 20px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                     <div class="title" style="font-weight: 600; color: #0f0f0f; margin-bottom: 12px;">Google Business Profile</div>
                     <div class="item-wrap" style="display: flex; align-items: center; gap: 12px;">
                        <div class="item">
                           <img src="assets/img/shape/profileShape1_1.png" alt="shape" style="width: 48px;">
                        </div>
                        <div class="item">
                           <div class="star-wrapper">
                              <img src="assets/img/icon/starIcon1_2.svg" alt="icon">
                              <img src="assets/img/icon/starIcon1_2.svg" alt="icon">
                              <img src="assets/img/icon/starIcon1_2.svg" alt="icon">
                           </div>
                           <h6 style="font-weight: bold; font-size: 16px; margin-top: 5px;">250+ reviews</h6>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <!-- Right Image -->
         <div class="order-2 col-xl-6 order-xl-2 justify-content-center" style="padding-top: 100px;">
            <div class="hero-thumb style1">
               <div class="main-thumb">
                  <img src="assets/img/webimg/image1.jpg" alt="Website design services in India" style="width: 100%; border-radius: 20px;">
               </div>
               <div class="shape1_1 d-none d-xxl-block">
                  <img src="assets/img/shape/heroShape1_1.png" alt="shape">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

         </div>
      </div>
   </section>
 
   Brand Slider Section S T A R T
   <div class="brand-slider-section fix">
      <div class="brand-slider-container-wrapper style1">
         <div class="container">
            <div class="row">
               <div class="slider-area brandSliderOne">
                  <div class="swiper gt-slider" id="brandSliderOne"
                     data-slider-options='{"loop": true, "breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":2,"centeredSlides":true},"768":{"slidesPerView":3},"992":{"slidesPerView":4},"1200":{"slidesPerView":5}}}'>
                     <div class="swiper-wrapper">
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/software-development1.png" alt="software-development">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/web-development1.png" alt="web-development">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/app-development1.png" alt="app-development">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/ui-design1.png" alt="ui/ux-design">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/digital-marketing1.png" alt="digital-marketing">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/seo1.png" alt="SEO">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/ecommerce-development1.png" alt="ecommerce-development">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/software-development1.png" alt="software-development">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/web-development1.png" alt="web-development">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/app-development1.png" alt="app-development">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/ui-design1.png" alt="ui/ux-design">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/digital-marketing1.png" alt="digital-marketing">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/seo1.png" alt="SEO">
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="brand-logo">
                              <img src="assets/img/brand-logo/ecommerce-development1.png" alt="ecommerce-development">
                           </div>
                        </div>
                        
                       
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->

   Service Section S T A R T
   <section class="service-section space fix" style="padding-top:20px">
      <div class="service-container-wrapper style1">
         <div class="container">
            <div class="title-wrap mb-45">
               <div class="section-title">
                  <div class="subtitle"> <img src="assets/img/icon/arrowLeft.svg" alt="icon"> <span> Our Services
                     </span><img src="assets/img/icon/arrowRight.svg" alt="icon"></div>
                  <h2 class="title">Better IT & Digital Marketing Solutions For Your Needs</h2>
               </div>
               <div class="arrow-btn text-end wow fadeInUp" data-wow-delay=".9s">
                  <button data-slider-prev="#serviceSliderOne" class="slider-arrow style1"><i
                        class="fa-sharp fa-regular fa-arrow-left-long"></i></button>
                  <button data-slider-next="#serviceSliderOne" class="slider-arrow style1 slider-next"><i
                        class="fa-regular fa-arrow-right-long"></i></button>
               </div>
            </div>

            <div class="row">
               <div class="slider-area serviceSliderOne">
                  <div class="swiper gt-slider" id="serviceSliderOne"
                     data-slider-options='{"loop": true, "breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":2,"centeredSlides":true},"768":{"slidesPerView":2},"992":{"slidesPerView":3},"1200":{"slidesPerView":4}}}'>
                     <div class="swiper-wrapper">
                        <div class="swiper-slide">
                           <div class="service-card style1">
                              <div class="icon">
                                 <img src="assets/img/icon/serviceIcon1_1.svg" alt="icon">
                              </div>
                              <div class="body">
                                 <h3> <a href="app-development">Application Development</a> </h3>
                                 <p>

                                    Application development services in India specialize in creating software applications that operate seamlessly across various platforms, including mobile devices and desktops.</p>
                                 <a href="app-development" class="link-btn style1">Read more <i
                                       class="fa-regular fa-chevrons-right"></i></a>
                              </div>
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="service-card style1">
                              <div class="icon">
                                 <img src="assets/img/icon/serviceIcon1_2.svg" alt="icon">
                              </div>
                              <div class="body">
                                 <h3> <a href="ecommercedevelopment">E-Commerce Website</a> </h3>
                                 <p> e-commerce website is a digital platform for buying and selling products or services online. Many businesses also offer e-commerce services in India to cater to local customers.</p>
                                 <a href="ecommercedevelopment" class="link-btn style1">Read more <i
                                       class="fa-regular fa-chevrons-right"></i></a>
                              </div>
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="service-card style1">
                              <div class="icon">
                                 <img src="assets/img/icon/serviceIcon1_3.svg" alt="icon">
                              </div>
                              <div class="body">
                                 <h3> <a href="digital-marketing">Digital Marketing</a> </h3>
                                 <p>

                                    Digital marketing involves promoting products, services, or brands through online platforms and digital technologies. It uses the internet to target audiences, including those in India.</p>
                                 <a href="digital-marketing" class="link-btn style1">Read more <i
                                       class="fa-regular fa-chevrons-right"></i></a>
                              </div>
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="service-card style1">
                              <div class="icon">
                                 <img src="assets/img/icon/serviceIcon1_4.svg" alt="icon">
                              </div>
                              <div class="body">
                                 <h3> <a href="website-development">Website Development</a> </h3>
                                 <p>Website design involves planning and organizing content to create an attractive and functional site. We expert website development services in India, focusing on user experience and customization.</p>
                                 <a href="website-development" class="link-btn style1">Read more <i
                                       class="fa-regular fa-chevrons-right"></i></a>
                              </div>
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="service-card style1">
                              <div class="icon">
                                 <img src="assets/img/icon/serviceIcon1_1.svg" alt="icon">
                              </div>
                              <div class="body">
                                 <h3> <a href="cloudhosting">Cloud Hosting</a> </h3>
                                 <p>Cloud Hosting uses a network of interconnected servers to host websites and applications. In India, several cloud hosting services provide scalable and reliable solutions.</p>
                                 <a href="cloudhosting" class="link-btn style1">Read more <i
                                       class="fa-regular fa-chevrons-right"></i></a>
                              </div>
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="service-card style1">
                              <div class="icon">
                                 <img src="assets/img/icon/serviceIcon1_2.svg" alt="icon">
                              </div>
                              <div class="body">
                                 <h3> <a href="uiuxdesgin">UI/UX Desgin</a> </h3>
                                 <p>UI (User Interface) Design focuses on creating visually appealing and functional interfaces. It includes services like button design and layout development, offered in India.</p>
                                 <a href="uiuxdesgin" class="link-btn style1">Read more <i
                                       class="fa-regular fa-chevrons-right"></i></a>
                              </div>
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="service-card style1">
                              <div class="icon">
                                 <img src="assets/img/icon/serviceIcon1_1.svg" alt="icon">
                              </div>
                              <div class="body">
                                 <h3> <a href="erpdevelopment">ERP Development</a> </h3>
                                 <p>ERP development focuses on creating software that integrates and streamlines business processes. Our ERP services in India enhance operational efficiency across industries.</p>
                                 <a href="erpdevelopment" class="link-btn style1">Read more <i
                                       class="fa-regular fa-chevrons-right"></i></a>
                              </div>
                           </div>
                        </div>
                        <div class="swiper-slide">
                           <div class="service-card style1">
                              <div class="icon">
                                 <img src="assets/img/icon/serviceIcon1_2.svg" alt="icon">
                              </div>
                              <div class="body">
                                 <h3> <a href="softwaredevelopment">Software Development</a> </h3>
                                 <p>Software development includes designing, creating, testing, and maintaining applications. In India, diverse services cater to businesses' software development needs.</p>
                                 <a href="softwaredevelopment" class="link-btn style1">Read more <i
                                       class="fa-regular fa-chevrons-right"></i></a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- About Section    S T A R T -->
  <section class="about-section fix" style="padding: 50px 0; background-color: #f9faff; font-family: 'Segoe UI', sans-serif;">
   <div class="about-container-wrapper style1">
      <div class="shape1"><img src="assets/img/shape/aboutShape1_1.png" alt="shape"></div>
      <div class="shape3"><img src="assets/img/shape/aboutShape1_3.png" alt="shape"></div>
      <div class="container">
         <div class="row gy-5 gx-70 d-flex align-items-center align-items-xl-start">
            <div class="col-xl-6">
               <div class="about-thumb">
                  <div class="thumb1">
                     <img class="img-custom-anim-left wow fadeInUp" data-wow-delay=".5s" src="assets/img/home/img 2.webp" alt="thumb" style="width: 100%; border-radius: 20px;">
                     <!-- SVG Mask -->
                     <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" style="position: absolute;">
                        <clipPath id="aboutThumbdMask1">
                           <path d="M0 20C0 8.95431 8.9543 0 20 0H395.5C423.114 0 445.5 22.3858 445.5 50V72.5C445.5 100.114 467.886 122.5 495.5 122.5H520C547.614 122.5 570 144.886 570 172.5V321.5L562.197 537.223C561.808 547.98 552.975 556.5 542.21 556.5H20C8.95432 556.5 0 547.546 0 536.5V20Z" />
                        </clipPath>
                     </svg>
                  </div>
                  <div class="shape"><a href="contact.php"><img class="rotate360" src="assets/img/shape/aboutShape1_4.png" alt="shape"></a></div>
               </div>
            </div>
            <div class="col-xl-6">
               <div class="about-content">
                  <div class="section-title mxw-560">
                     <h6 class="subtitle wow fadeInUp" data-wow-delay=".3s" style="font-size: 16px; font-weight: 600;display: flex; align-items: center; gap: 8px;">
                        <img
                              src="assets/img/icon/arrowLeft.svg" alt="icon"> 
                              about company 
                           </span><img src="assets/img/icon/arrowRight.svg" alt="icon"></div>
                     </h6>

                     <h1 class="wow fadeInUp" data-wow-delay=".6s" style="font-size: 48px; line-height: 1.2; font-weight: 800; color: #0f0f0f; margin-top: 15px;">
                       <span style="color: #007bff;"> Who</span> <span style="color: #00bfff;"> We Are</span>
                     </h1>

                     <p class="wow fadeInUp" data-wow-delay=".5s" style="color: #333; margin-top: 15px; font-size: 16px;">
                        We are a pool of talented developers who make IT solutions simple and effective. At Apricorn Solutions, we specialize in providing end-to-end solutions for your business challenges, including top-notch website development services in India. Our team of professionals brings together innovative ideas and collective expertise to help shape a better future with a greater purpose. Regardless of where the solutions originate, we seamlessly integrate all necessary services and technologies to assist clients in addressing their most critical business problems.
                     </p>
                  </div>

                  <div class="fancy-box-wrapper style2 mt-3">
                        <div class="fancy-box style2 wow fadeInUp bg-white" data-wow-delay=".3s">
                           <div class="item">
                              <div class="icon"><img src="assets/img/icon/aboutIcon1_1.svg" alt="icon"></div>
                           </div>
                           <div class="item">
                              <h6 class="text-black">Software Development</h6>
                           </div>
                        </div>
                        <div class="fancy-box style2 wow fadeInUp bg-white" data-wow-delay=".5s">
                           <div class="item">
                              <div class="icon"><img src="assets/img/icon/aboutIcon1_1.svg" alt="icon"></div>
                           </div>
                           <div class="item">
                              <h6 class="text-black">Website Development</h6>
                           </div>
                        </div>
                     </div>

                  <div class="counter-box-wrapper style1 gap-2 gap-md-4" style="margin-top: 30px;">
                     <div class="counter-box style1 wow fadeInUp" data-wow-delay=".3s" style="background: #ffffff; padding: 20px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 20px;">
                        <h3 style="font-weight: bold; font-size: 28px; color: #0f0f0f;"><span class="counter-number">170</span>+</h3>
                        <h6 style="color: #555;">Projects Done</h6>
                     </div>
                     <div class="counter-box style1 wow fadeInUp" data-wow-delay=".5s" style="background: #ffffff; padding: 20px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 20px;">
                        <h3 style="font-weight: bold; font-size: 28px; color: #0f0f0f;"><span class="counter-number">200</span>+</h3>
                        <h6 style="color: #555;">Happy Clients</h6>
                     </div>
                     <div class="counter-box style1 wow fadeInUp" data-wow-delay=".8s" style="background: #ffffff; padding: 20px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 20px;">
                        <h3 style="font-weight: bold; font-size: 28px; color: #0f0f0f;"><span class="counter-number">10</span>+</h3>
                        <h6 style="color: #555;">Team Members</h6>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


   <!-- Project Section S T A R T -->
   <section class="project-section space fix">
      <div class="project-container-wrapper style1">
         <div class="container">
            <div class="mx-auto mb-10 section-title title-area">
               <div class="subtitle d-flex justify-content-center"> <img src="assets/img/icon/arrowLeft.svg" alt="icon">
                  <span>Connect With our work
                  </span><img src="assets/img/icon/arrowRight.svg" alt="icon">
               </div>
               <h3 class="text-center title">Apricorn Solutions Latest Portfolios</h3>
            </div>
            <div class="project-item-wrapper style1">
               <div class="project-item-card style1 wow fadeInUp" data-wow-delay=".2s">
                  <div class="project-icon">
                     <img src="assets/img/icon/projectItemIcon1_1.svg" alt="icon">
                  </div>
                  <h5>Search Engine Optimisation</h5>
               </div>
               <div class="project-item-card style1 wow fadeInUp" data-wow-delay=".4s">
                  <div class="project-icon">
                     <img src="assets/img/icon/projectItemIcon1_2.svg" alt="icon">
                  </div>
                  <h5>Website Development</h5>
               </div>
               <div class="project-item-card style1 active wow fadeInUp" data-wow-delay=".6s">
                  <div class="project-icon">
                     <img src="assets/img/icon/projectItemIcon1_3.svg" alt="icon">
                  </div>
                  <h5>Application Development</h5>
               </div>
               <div class="project-item-card style1 wow fadeInUp" data-wow-delay=".8s">
                  <div class="project-icon">
                     <img src="assets/img/icon/projectItemIcon1_4.svg" alt="icon">
                  </div>
                  <h5>Software Development</h5>
               </div>
               <div class="project-item-card style1 wow fadeInUp" data-wow-delay="1s">
                  <div class="project-icon">
                     <img src="assets/img/icon/projectItemIcon1_5.svg" alt="icon">
                  </div>
                  <h5>Performance Marketing</h5>
               </div>
            </div>
            <div class="project-wrapper style1">
               <div class="row gy-5 gx-60">
                  <div class="col-xl-5">
                     <div class="project-thumb img-custom-anim-left wow fadeInUp" data-wow-delay=".5s">
                        <img src="assets/img/home/home3.png" alt="thumb" style="border-radius:10px;">
                     </div>
                  </div>
                  <div class="col-xl-7">
                     <div class="project-content-wrapper style1">
                        <div class="project-content style1">
                           <div class="row">
                              <div class="col-xl-9">
                                 <div class="project-content-left">
                                    <h3>Detailing of our Company</h3>
                                    <p class="text">Apricorn Solutions is a software development company, including Web development services in India, offering innovative services tailored to meet the unique needs of businesses.</p>
                                    <div class="fancy-box-wrapper style3">
                                       <div class="fancy-box style3">
                                          <div class="item">
                                             <div class="icon">
                                                <img src="assets/img/icon/pricingIcon1_2.svg" alt="icon">
                                             </div>
                                          </div>
                                          <div class="item">
                                             <h6>Responsive website</h6>
                                          </div>
                                       </div>
                                       <div class="fancy-box style3">
                                          <div class="item">
                                             <div class="icon">
                                                <img src="assets/img/icon/projectIcon1_2.svg" alt="icon">
                                             </div>
                                          </div>
                                          <div class="item">
                                             <h6>100% Customers Satisfaction</h6>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="fancy-box style3">
                                       <div class="item">
                                          <div class="icon">
                                             <img src="assets/img/icon/projectIcon1_3.svg" alt="icon">
                                          </div>
                                       </div>
                                       <div class="item">
                                          <h6>Advertisement Expert</h6>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-xl-3">
                                 <!-- <div class="project-content-right">
                                    <img class="img-custom-anim-right wow fadeInUp" data-wow-delay=".6s"
                                       src="assets/img/webimg/prt1.png" alt="thumb">
                                 </div> -->
                              </div>
                           </div>

                           <!-- SVG Mask -->
                           <svg xmlns="http://www.w3.org/2000/svg" width="0" height="0" style="position: absolute;">
                              <clipPath id="projectContentdMask">
                                 <path
                                    d="M0 16C0 7.16344 7.16344 0 16 0H746C754.837 0 762 7.16344 762 16V354C762 362.837 754.837 370 746 370H454.326C432.82 370 412.992 358.378 402.484 339.614L401.681 338.18C379.099 297.856 320.881 298.393 299.048 339.127C288.859 358.136 269.04 370 247.472 370H16C7.16344 370 0 362.837 0 354V16Z" />
                              </clipPath>
                           </svg>
                        </div>

                        <div class="shape"><a href="project-details.php"><img class="rotate360"
                                 src="assets/img/shape/projectShape1_1.png" alt="shape"></a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>



   <!-- Work Process Section   S T A R T -->
   <section class="work-process-section space bg-theme-color2 fix">
      <div class="pb-0 work-process-wrapper style1 space">
         <div class="container">
            <div class="row gy-5">
               <div class="col-xl-3">
                  <div class="work-process-card style1 active wow fadeInUp" data-wow-delay=".2s">
                     <div class="number">01</div>
                     <h3 class="title">Website Designing</h3>
                     <p class="text">We create modern, visually appealing, and user-friendly website designs that reflect your brand’s identity. Our responsive designs ensure seamless navigation across all devices, providing an engaging user experience and enhancing customer interaction.</p>
                  </div>
               </div>
               <div class="col-xl-3">
                  <div class="work-process-card style1 active wow fadeInUp" data-wow-delay=".4s">
                     <div class="number">02</div>
                     <h3 class="title">Website Development</h3>
                     <p class="text">Our expert developers build high-performance, secure, and scalable websites using the latest technologies. Whether you need a business website, e-commerce platform, or custom web solution, we ensure a smooth, fast, and bug-free experience tailored to your needs.</p>
                  </div>
               </div>
               <div class="col-xl-3">
                  <div class="work-process-card style1 active wow fadeInUp" data-wow-delay=".6s">
                     <div class="number">03</div>
                     <h3 class="title">Digital Marketing</h3>
                     <p class="text">We enhance your online presence through SEO, social media marketing, and paid advertising. Our data-driven strategies improve brand visibility, drive organic traffic, and boost conversions, helping your business reach the right audience effectively.</p>
                  </div>
               </div>
               <div class="col-xl-3">
                  <div class="work-process-card style1 active wow fadeInUp" data-wow-delay=".8s">
                     <div class="number">04</div>
                     <h3 class="title">Optimization</h3>
                     <p class="text">We optimize your website for speed, security, and search engine rankings. From faster load times and mobile responsiveness to content optimization and technical SEO, we ensure your site performs at its best, providing a seamless experience for users and better rankings on search engines.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>


   
   <!-- Faq Section   S T A R T -->
   <section class="blog-section space fix">
      <div class="pt-0 blog-wrapper style1">
         <div class="container">
            <div class="title-wrap mb-3"> <!-- mb-3 se gap kam ho jayega -->
               <div class="section-title">
                  <div class="subtitle">
                     <img src="assets/img/icon/arrowLeft.svg" alt="icon">
                     <span> Blog & News </span>
                     <img src="assets/img/icon/arrowRight.svg" alt="icon">
                  </div>
                  <h3 class="title">Featured News And Insights</h3>
               </div>
            </div>

            <?php if (!empty($result) && $result->num_rows > 0) { ?>
              <div class="blog-slider d-flex overflow-auto" style="display: flex; gap: 15px; overflow-x: auto; padding: 20px; scroll-behavior: smooth;">
   <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="col-md-6 col-lg-4 flex-shrink-0" style="flex: 0 0 auto; width: 300px;">
         <div class="news-card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
            <div class="news-image position-relative" style="position: relative;">
               <img src="/admin/uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Blog Image" style="width: 100%; height: 200px; object-fit: cover;">
               <div class="post-date" style="position: absolute; top: 10px; left: 10px; background-color: #007bff; color: #fff; padding: 6px 10px; border-radius: 4px; text-align: center;">
                  <h3 style="margin: 0; font-size: 18px;">
                     <?php echo date('d', strtotime($row['created_at'])); ?>
                     <span style="display: block; font-size: 14px;"><?php echo date('M', strtotime($row['created_at'])); ?></span>
                  </h3>
               </div>
            </div>
            <div class="news-content" style="padding: 15px;">
               <ul style="list-style: none; padding: 0; margin: 0 0 10px 0; font-size: 14px; color: #666;">
                  <li style="margin-bottom: 5px;"><i class="far fa-user"></i> By Admin</li>
                  <li><i class="fas fa-tag"></i> <?php echo htmlspecialchars($row['category']); ?></li>
               </ul>
               <h3 class="news-title" style="font-size: 18px; margin: 0 0 10px;">
                  <a href="blogdetails.php?id=<?php echo (int) $row['id']; ?>" style="text-decoration: none; color: #333;">
                     <?php echo htmlspecialchars($row['title']); ?>
                  </a>
               </h3>
               <a href="blogdetails?slug=<?php echo urlencode($row['slug']); ?>" style="display: inline-block; background-color: #007bff; color: #fff; padding: 8px 12px; text-decoration: none; border-radius: 4px; font-size: 14px;">
                  Read More <i class="fas fa-arrow-right"></i>
               </a>
            </div>
         </div>
      </div>
   <?php } ?>
</div>

            <?php } else { ?>
               <p class="text-center">No blog posts found.</p>
            <?php } ?>
         </div>
      </div>
   </section>

   <style>
      .blog-slider {
         display: flex;
         gap: 15px;
         overflow-x: auto;
         scroll-snap-type: x mandatory;
         padding-bottom: 5px;
      }

      .news-card {
         width: 280px;
         scroll-snap-align: start;
      }

      .blog-section {
         margin-bottom: 0 !important;
         padding-bottom: 0 !important;
      }

      .blog-wrapper {
         margin-bottom: 0 !important;
         padding-bottom: 0 !important;
      }
   </style>

   <!-- Cta Section   S T A R T -->
   <section class="pb-0 cta-section space" style="padding-top: 50px; font-family: 'Segoe UI', sans-serif; border-radius: 20px;">
   <div class="container">
      <div class="cta-wrap style1 fix" style="position: relative;background-color: #f9faff;">
         <div class="shape">
            <img src="assets/img/shape/ctaShape1_1.png" alt="shape">
         </div>
         <div class="row gy-5 align-items-center">
            <!-- Left Image -->
            <div class="col-xl-3">
               <div class="cta-thumb img-custom-anim-left wow fadeInUp" data-wow-delay=".2s">
                  <img src="assets/img/webimg/young-man-using-desktop-computer-sitting-in-chair-with-desk-free-vector-removebg-preview.png" alt="thumb" style="max-width: 100%; border-radius: 16px;">
               </div>
            </div>

            <!-- Center Text -->
            <div class="col-xl-6 d-flex align-items-center">
               <div class="section-title">
                  <div class="subtitle" style="font-size: 20px; font-weight: 600; color: #1a73e8; display: flex; align-items: center; gap: 6px;">
                     <img src="assets/img/icon/arrowLeft.svg" alt="icon">
                     <span style="color: #1a73e8;">Contact Us</span>
                     <img src="assets/img/icon/arrowRight.svg" alt="icon">
                  </div>
                  <h3 class="title" style="font-size: 36px; font-weight: 800; color: #0f0f0f; margin-top: 10px;">
                     24/7 Expert Support
                  </h3>
               </div>
            </div>

            <!-- Right Button -->
            <div class="col-xl-3 d-flex align-items-center justify-content-xl-end">
               <div class="btn-wrapper">
                  <a class="gt-btn style5" href="contactus" style="background-color: #1a73e8; padding: 15px 20xpx; border-radius: 30px; color: white; font-weight: 600; text-decoration: none;display:flex; flex-direction:column; gap:6px">
                     <span> Talk to a Specialist </span>
                     <i class="fa-sharp fa-regular fa-arrow-right-long"></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


   <!-- Testimonial Section   S T A R T -->
   <section class="testimonial-section space pb-0 fix wow fadeInUp" data-wow-delay=".2s"
      data-bg-src="assets/img/bg/testimonialBg1_1.png">
      <div class="testimonial-wrap style3">
         <div class="container" style="margin-top:180px; padding-bottom:20px">
            <div class="row">
               <div class="col-12 d-flex justify-content-center">
                  <div class="section-title title-area mb-50 mx-auto">
                     <div class="subtitle d-flex justify-content-center"> <img src="assets/img/icon/arrowLeft.svg"
                           alt="icon"> <span> Testimonials
                        </span><img src="assets/img/icon/arrowRight.svg" alt="icon"></div>
                     <h3 class="title text-center">Our Latest Client Feedback</h3>
                  </div>
               </div>
            </div>
            <div class="slider-area">
               <div class="swiper gt-slider testimonial-slider3" id="testimonialSlider3"
                  data-slider-options='{"loop": true,"centeredSlides":true, "breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":1},"768":{"slidesPerView":1},"992":{"slidesPerView":2},"1200":{"slidesPerView":3}}}'>
                  <div class="swiper-wrapper" style="height:380px">
                     <div class="swiper-slide">
                        <div class="testimonial-card style3 img-custom-anim-left wow fadeInUp" data-wow-delay=".2s">
                           <ul class="star-wrap">
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIconRegular.png" alt="icon"></li>
                           </ul>
                           <p class="text">Apricorn Solutions ne hamari purani website ko ek modern aur user-friendly platform me badal diya. Unka attention to detail aur technical expertise laajawab tha. Highly recommend.
                           </p>
                           <div class="profile-box">
                              <div class="testi-thumb">
                                 <img src="assets/img/webimg/155-1550391_faces-in-circle-png-transparent-png-removebg-preview.png" alt="thumb">
                              </div>
                              <div class="testi-content">
                                 <h3 class="title">Rohit Sharma</h3>
                                 <div class="designation"></div>
                              </div>
                           </div>
                           <div class="quote">
                              <img class="darkQuote" src="assets/img/icon/quoteIconDark.png" alt="icon">
                              <img class="whiteQuote" src="assets/img/icon/quoteIconWhite.png" alt="icon">
                           </div>
                           <div class="shape3_1"><img src="assets/img/shape/testimonialShape3_1.png" alt="shape">
                           </div>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="testimonial-card style3 img-custom-anim-left wow fadeInUp" data-wow-delay=".2s">
                           <ul class="star-wrap">
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIconRegular.png" alt="icon"></li>
                           </ul>
                           <p class="text">Working with Apricorn Solutions has been a seamless experience. They delivered a custom software solution on time and within budget. Truly a dependable partner.
                           </p>
                           <div class="profile-box">
                              <div class="testi-thumb">
                                 <img src="assets/img/webimg/404-4042710_circle-profile-picture-png-transparent-png-removebg-preview.png" alt="thumb">
                              </div>
                              <div class="testi-content">
                                 <h3 class="title">Priya Mehta</h3>
                                 <div class="designation"></div>
                              </div>
                           </div>
                           <div class="quote">
                              <img class="darkQuote" src="assets/img/icon/quoteIconDark.png" alt="icon">
                              <img class="whiteQuote" src="assets/img/icon/quoteIconWhite.png" alt="icon">
                           </div>
                           <div class="shape3_1"><img src="assets/img/shape/testimonialShape3_1.png" alt="shape">
                           </div>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="testimonial-card style3 img-custom-anim-left wow fadeInUp" data-wow-delay=".2s">
                           <ul class="star-wrap">
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIconRegular.png" alt="icon"></li>
                           </ul>
                           <p class="text">We approached Apricorn Solutions for an e-commerce website, and their innovative approach set us apart from competitors. The team is incredibly creative and responsive.
                           </p>
                           <div class="profile-box">
                              <div class="testi-thumb">
                                 <img src="assets/img/webimg/img4-removebg-preview.png" alt="thumb">
                              </div>
                              <div class="testi-content">
                                 <h3 class="title">Aman Verma</h3>
                                 <div class="designation"></div>
                              </div>
                           </div>


                           <div class="quote">
                              <img class="darkQuote" src="assets/img/icon/quoteIconDark.png" alt="icon">
                              <img class="whiteQuote" src="assets/img/icon/quoteIconWhite.png" alt="icon">
                           </div>

                           <div class="shape3_1"><img src="assets/img/shape/testimonialShape3_1.png" alt="shape">
                           </div>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="testimonial-card style3 img-custom-anim-left wow fadeInUp" data-wow-delay=".2s">
                           <ul class="star-wrap">
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIconRegular.png" alt="icon"></li>
                           </ul>
                           <p class="text">The Apricorn Solutions team is knowledgeable and highly responsive. They revamped our website. Their support post-launch has been outstanding.
                           </p>
                           <div class="profile-box">
                              <div class="testi-thumb">
                                 <img src="assets/img/webimg/348-3481514_circle-profile-girl-hd-png-download-removebg-preview.png" alt="thumb">
                              </div>
                              <div class="testi-content">
                                 <h3 class="title">Neha Gupta</h3>
                                 <div class="designation"></div>
                              </div>
                           </div>
                           <div class="quote">
                              <img class="darkQuote" src="assets/img/icon/quoteIconDark.png" alt="icon">
                              <img class="whiteQuote" src="assets/img/icon/quoteIconWhite.png" alt="icon">
                           </div>
                           <div class="shape3_1"><img src="assets/img/shape/testimonialShape3_1.png" alt="shape">
                           </div>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="testimonial-card style3 img-custom-anim-left wow fadeInUp" data-wow-delay=".2s">
                           <ul class="star-wrap">
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIconRegular.png" alt="icon"></li>
                           </ul>
                           <p class="text">Apricorn Solutions ne hamara mobile app design kiya aur results lajawab the. App fast, intuitive, aur bilkul waise hi hai jaise hume apne business ke liye chahiye tha.
                           </p>
                           <div class="profile-box">
                              <div class="testi-thumb">
                                 <img src="assets/img/webimg/Round-Profile-Pic-removebg-preview.png" alt="thumb">
                              </div>
                              <div class="testi-content">
                                 <h3 class="title">Kunal Sinha</h3>
                                 <div class="designation"></div>
                              </div>
                           </div>
                           <div class="quote">
                              <img class="darkQuote" src="assets/img/icon/quoteIconDark.png" alt="icon">
                              <img class="whiteQuote" src="assets/img/icon/quoteIconWhite.png" alt="icon">
                           </div>
                           <div class="shape3_1"><img src="assets/img/shape/testimonialShape3_1.png" alt="shape">
                           </div>
                        </div>
                     </div>
                     <div class="swiper-slide">
                        <div class="testimonial-card style3 img-custom-anim-left wow fadeInUp" data-wow-delay=".2s">
                           <ul class="star-wrap">
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIcon2.png" alt="icon"></li>
                              <li><img src="assets/img/icon/starIconRegular.png" alt="icon"></li>
                           </ul>
                           <p class="text">Apricorn Solutions ke saath collaborate karna humare best decisions me se ek tha. Unhone hume IT consulting aur tailored solutions diye jo hamari operational efficiency badhane me madadgar rahe.
                           </p>
                           <div class="profile-box">
                              <!-- <div class="testi-thumb">
                                 <img src="assets/img/webimg/img4-removebg-preview.png" alt="thumb">
                              </div> -->
                              <div class="testi-thumb">
                                 <img src="assets/img/webimg/348-3481514_circle-profile-girl-hd-png-download-removebg-preview.png" alt="thumb">
                              </div>
                              <div class="testi-content">
                                 <h3 class="title">Meera Jain</h3>
                                 <div class="designation"></div>
                              </div>
                           </div>
                           <div class="quote">
                              <img class="darkQuote" src="assets/img/icon/quoteIconDark.png" alt="icon">
                              <img class="whiteQuote" src="assets/img/icon/quoteIconWhite.png" alt="icon">
                           </div>
                           <div class="shape3_1"><img src="assets/img/shape/testimonialShape3_1.png" alt="shape">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="slider-pagination"></div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- Blog Section    S T A R T -->



   <!-- Faq Section   S T A R T -->
   <section class="pb-0 faq-section space fix">
      <div class="container">
         <div class="faq-wrapper style1">
            <div class="row gy-5">
               <div class="col-xl-6">
                  <div class="faq-thumb">
                     <img class="thumb1 img-custom-anim-top wow fadeInUp" data-wow-delay=".2s"
                        src="assets/img/home/home-7.jpg" alt="thumb">
                     <!-- <div class="thumb2"><img src="assets/img/webimg/faqThumb1_2.png" alt="thumb"></div> -->
                  </div>
               </div>
               <div class="col-xl-6">
                  <div class="section-title mxw-560">
                     <div class="subtitle"> <img src="assets/img/icon/arrowLeft.svg" alt="icon"> <span> Faq
                        </span><img src="assets/img/icon/arrowRight.svg" alt="icon"></div>
                     <h3 class="title">We have answers to all your questions and solutions for every need</h3>
                  </div>
                  <div class="faq-content style1">
                     <div class="faq-accordion">
                        <div class="accordion" id="accordion">
                           <div class="mb-3 accordion-item wow fadeInUp" data-wow-delay=".3s">
                              <h5 class="accordion-header">
                                 <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                    1. What services does Apricorn Solutions offer?
                                 </button>
                              </h5>
                              <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                 <div class="accordion-body">
                                    We provide a comprehensive range of IT and software development services, including web design and development, mobile app development, digital marketing, cloud computing, and IT consulting services.
                                 </div>
                              </div>
                           </div>
                           <div class="mb-3 accordion-item wow fadeInUp" data-wow-delay=".5s">
                              <h5 class="accordion-header">
                                 <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                    2. Do you offer website development services in India?
                                 </button>
                              </h5>
                              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                 <div class="accordion-body">
                                    Yes, we specialize in web design and development solutions in India and beyond, delivering modern, user-friendly websites tailored to your business needs.
                                 </div>
                              </div>
                           </div>
                           <div class="mb-3 accordion-item wow fadeInUp" data-wow-delay=".7s">
                              <h5 class="accordion-header">
                                 <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                    3. How long does it take to build a website?
                                 </button>
                              </h5>
                              <div id="faq3" class="accordion-collapse show" data-bs-parent="#accordion">
                                 <div class="accordion-body">
                                    The timeline depends on the complexity and scope of the project. Typically, a standard business website takes 4–6 weeks, while more complex websites may take longer.
                                 </div>
                              </div>
                           </div>
                           <div class="accordion-item wow fadeInUp" data-wow-delay=".7s">
                              <h5 class="accordion-header">
                                 <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                    4. Do you offer e-commerce website development?
                                 </button>
                              </h5>
                              <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                 <div class="accordion-body">
                                    Yes, we build secure, scalable, and feature-rich e-commerce websites that enable businesses to sell their products and services online.
                                 </div>
                              </div>
                           </div>
                           <!--<div class="accordion-item wow fadeInUp" data-wow-delay=".7s">-->
                           <!--   <h5 class="accordion-header">-->
                           <!--      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"-->
                           <!--         data-bs-target="#faq5" aria-expanded="false" aria-controls="faq4">-->
                           <!--         5.Do you offer e-commerce website development?-->
                           <!--      </button>-->
                           <!--   </h5>-->
                           <!--   <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#accordion">-->
                           <!--      <div class="accordion-body">-->
                           <!--         Yes, we build secure, scalable, and feature-rich e-commerce websites that enable businesses to sell their products and services online.-->
                           <!--      </div>-->
                           <!--   </div>-->
                           <!--</div>-->
                           <!--<div class="accordion-item wow fadeInUp" data-wow-delay=".7s">-->
                           <!--   <h5 class="accordion-header">-->
                           <!--      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"-->
                           <!--         data-bs-target="#faq6" aria-expanded="false" aria-controls="faq4">-->
                           <!--         6.Do you offer e-commerce website development?-->
                           <!--      </button>-->
                           <!--   </h5>-->
                           <!--   <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#accordion">-->
                           <!--      <div class="accordion-body">-->
                           <!--         Yes, we build secure, scalable, and feature-rich e-commerce websites that enable businesses to sell their products and services online.-->
                           <!--      </div>-->
                           <!--   </div>-->
                           <!--</div>-->



                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Cta Section   S T A R T -->

   <!-- <script src="script.js"></script> -->
   
   <script>
       
      $('#connectForm').submit(function(e){
    e.preventDefault();

    $.ajax({
        url: "connect_submit.php",
        method: "POST",
        data: $(this).serialize(),
        success: function(response){
            alert(response);
            $('#connectModal').modal('hide');
            $('#connectForm')[0].reset();
        },
        error: function(){
            alert('Error! Please try again.');
        }
    });
});
   </script>
   <script>
      document.addEventListener('DOMContentLoaded', () => {
         // Show content1 by default and hide all other content sections
         document.querySelectorAll('.content').forEach(content => {
            content.style.display = 'none'; // Hide all content sections
         });
         document.getElementById('content1').style.display = 'block'; // Show content1
      });

      document.querySelectorAll('.show-btn').forEach(button => {
         button.addEventListener('click', () => {
            // Get the ID of the content to show from the button's data attribute
            const contentId = button.getAttribute('data-content');

            // Hide all content sections
            document.querySelectorAll('.content').forEach(content => {
               content.style.display = 'none';
            });

            // Show the selected content
            const contentToShow = document.getElementById(contentId);
            if (contentToShow) {
               contentToShow.style.display = 'block';
            } else {
               console.error(`Element with ID '${contentId}' not found.`);
            }
         });
      });
   </script>





   <!-- Footer Area   S T A R T -->
   <?php
   include 'footer.php';
   ?>