
    <?php
    require './admin/db_connect.php';

    // Sanitize the incoming slug from GET request to prevent XSS and other attacks
    $slug = isset($_GET['slug']) ? htmlspecialchars($_GET['slug'], ENT_QUOTES, 'UTF-8') : '';

    // Debug: Check if the slug is coming through correctly
    // $geopostion = '';
    // var_dump($slug);

    // Fetching the data from the database using prepared statements
    $sql = "SELECT * FROM work_process_steps ORDER BY step_number ASC";
    $result1 = $conn->query($sql);
    $sql = "SELECT * FROM faqs ORDER BY id ASC";
    $result2 = $conn->query($sql);
    $page_id = isset($_GET['page_id']) ? intval($_GET['page_id']) : 1;
    $sql = "SELECT * FROM pages";
    $result = $conn->query($sql);
    $sql = "SELECT * FROM addedblogs ORDER BY created_at DESC LIMIT 2";
    $result3 = $conn->query($sql);
    $geoposition = '';
    $base_url = ""; // You can set a default value if it's optional or fetch it from another source

    // For example, if you're fetching it from user input, an API, or database, make sure it’s defined like this:
    if (isset($_GET['geoposition'])) {
        $geoposition = $_GET['geoposition'];
    }
    if ($slug !== '') {

        // Check if the database connection was successful
        if ($conn) {
            $stmt = $conn->prepare("SELECT title, content, keyword, geoplacename, georegion, geoposition, icbm, canonical,  carouseltext, servicehading, servicename , servicedesc , icon, company_details, work_title, icon2  FROM pages WHERE slug = ?");
            $stmt->bind_param("s", $slug);
            $stmt->execute();
            $stmt->bind_result($title, $content, $keyword, $geoplacename, $georegion, $geopostion, $icbm, $canonical, $carouseltext, $servicehading, $servername, $servicedes, $icon, $company_details, $work_title, $icon2);
            $stmt->fetch();
            $stmt->close();
            // var_dump($slug);
            // Check if title and content exist, then display them
            // var_dump($title, $content, $keyword, $geoplacename, $georegion, $geopostion, $icbm);

            if ($title && $content) {

                echo "<!DOCTYPE html>";
                echo "<html lang='zxx'>";
                echo "<head>";
                echo "<meta charset='UTF-8'>";
                echo "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
                echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
                echo "<meta name='author' content='ex-coders'>";
                echo "<meta name='description' content='$content'>";
                echo "<meta name='keywords' content='$keyword'>";
                echo "<meta name='geo.placename' content='$geoplacename' />";
                echo "<meta name='geo.region' content='$georegion' />";
                echo "<meta name='geo.position' content='$geoposition'>";
                echo "<meta name='ICBM' content='$icbm'>";
                echo "<link rel='canonical' href='$canonical' />";
                echo "<link rel='alternate' hreflang='en' href='https://newwebsite.apricornsolutions.com/index.php/en/' />";
                echo "<link rel='alternate' hreflang='hi' href='https://newwebsite.apricornsolutions.com/index.php/hi/' />";
                echo "<title>" . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . "</title>";
                echo "<link rel='shortcut icon' href='assets/img/favicon.svg'>";
                echo "<link rel='stylesheet' href='assets/css/bootstrap.min.css'>";
                echo "<link rel='stylesheet' href='assets/css/all.min.css'>";
                echo "<link rel='stylesheet' href='assets/css/animate.css'>";
                echo "<link rel='stylesheet' href='assets/css/magnific-popup.css'>";
                echo "<link rel='stylesheet' href='assets/css/meanmenu.css'>";
                echo "<link rel='stylesheet' href='assets/css/swiper-bundle.min.css'>";
                echo "<link rel='stylesheet' href='assets/css/nice-select.css'>";
                echo "<link rel='stylesheet' href='assets/css/main.css'>";
                echo "</head>";
                echo " <style>
                    .service-container-wrapper {
                        display: flex;
                        flex-wrap: wrap;
                    }
            
                    .service-card {
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                        height: 100%;
                    }
            
                    .service-card .body {
                        flex-grow: 1;
                        overflow: hidden;
                        transition: max-height 0.3s ease-in-out;
                    }
            
                    .service-card .body p {
                        max-height: 3em;
                        /* Limit the visible text */
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }
            
                    .service-card .body.expanded p {
                        max-height: none;
                        /* Expand to show the full text */
                    }
            
                    .link-btn {
                        margin-top: auto;
                        /* Ensure button stays at the bottom */
                        
                    }
                            .service-desc {
        max-height: 100px; /* Limit initial height */
        overflow: hidden;
        transition: max-height 0.3s ease-in-out;
    }

    .read-more-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 14px;
        margin-top: 10px;
    }

    .read-more-btn:hover {
        background-color: #0056b3;
    }
     ul.submenu {
            display: none;
            position: absolute;
            background-color: white;
            padding: 10px 0;
            min-width: 200px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* Positioning the dropdown correctly */
        .has-dropdown {
            position: relative;
        }

        /* Show submenu on hover */
        .has-dropdown:hover>.submenu {
            display: block;
        }

        /* Style submenu items */
        ul.submenu li {
            list-style: none;
        }

        ul.submenu li a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
        }

        ul.submenu li a:hover {
            background-color: #f5f5f5;
        }
        
        .service-card .body p {
        min-height:13em;
    max-height: 13em;
    overflow: hidden;
      }   
            </style>";
                echo "<body>";
                echo " <div id='preloader' class='preloader'>";
                echo " <div class='animation-preloader'>";
                echo "<div class='spinner'>";
                echo " </div>";
                echo " <div class='txt-loading'>";
                echo "<span data-text-preloader='A' class='letters-loading'>
                                A
                            </span>";
                echo "<span data-text-preloader='P' class='letters-loading'>
                                P
                            </span>";
                echo "<span data-text-preloader='R' class='letters-loading'>
                                R
                            </span>";
                echo "<span data-text-preloader='I' class='letters-loading'>
                                I
                            </span>";
                echo "<span data-text-preloader='C' class='letters-loading'>
                                C
                            </span>";
                echo "<span data-text-preloader='O' class='letters-loading'>
                                O
                            </span>";
                echo "<span data-text-preloader='R' class='letters-loading'>
                                R
                            </span>";
                echo "<span data-text-preloader='N' class='letters-loading'>
                                N
                            </span>";
                echo "</div>";
                echo " <p class='text-center'>Loading</p>";
                echo " </div>";
                echo "<div class='loader'>";
                echo "<div class='row'>";
                echo "<div class='col-3 loader-section section-left'>";
                echo "<div class='bg'>";
                echo "</div>";
                echo "</div>";
                echo " <div class='col-3 loader-section section-left'>";
                echo "<div class='bg'></div>";
                echo "  </div>";
                echo "<div class='col-3 loader-section section-right'>";
                echo "<div class='bg'></div>";
                echo "</div>";
                echo " <div class='col-3 loader-section section-right'>";
                echo "<div class='bg'>";
                echo "</div>";
                echo "</div>";
                echo " </div>";
                echo " </div>";
                echo "</div>";
                echo "<div class='mouse-cursor cursor-outer'>";
                echo "</div>";
                echo "<div class='mouse-cursor cursor-inner'>";
                echo "</div>";

                echo "
            <div class='fix-area'>
                <div class='offcanvas__info'>
                    <div class='offcanvas__wrapper'>
                        <div class='offcanvas__content'>
                            <div class='offcanvas__top mb-5 d-flex justify-content-between align-items-center'>
                                <div class='offcanvas__logo'>
                                    <a href='index.php'>
                                        <img src='assets/img/webimg/apricron.png' alt='Apricorn Solutions logo'>
                                    </a>
                                </div>
                                <div class='offcanvas__close'>
                                    <button>
                                        <i class='fas fa-times'></i>
                                    </button>
                                </div>
                            </div>
                            <p class='text d-none d-lg-block'>
                               
                            </p>
                            <div class='mobile-menu fix mb-3'></div>
                            <div class='offcanvas__contact'>
                                <h4>Contact Info</h4>
                                <ul>
                                    <li class='d-flex align-items-center'>
                                        <div class='offcanvas__contact-icon'>
                                            <i class='fal fa-map-marker-alt'></i>
                                        </div>
                                        <div class='offcanvas__contact-text'>
                                            <a target='_blank' href='#'>Unique shopping mall, sonipat</a>
                                        </div>
                                    </li>
                                    <li class='d-flex align-items-center'>
                                        <div class='offcanvas__contact-icon mr-15'>
                                            <i class='fal fa-envelope'></i>
                                        </div>
                                        <div class='offcanvas__contact-text'>
                                            <a href='mailto:apricornsolutions@gmail.com'><span class='mailto:apricornsolutions@gmail.com'>apricornsolutions@gmail.com</span></a>
                                        </div>
                                    </li>
                                    <li class='d-flex align-items-center'>
                                        <div class='offcanvas__contact-icon mr-15'>
                                            <i class='fal fa-clock'></i>
                                        </div>
                                        <div class='offcanvas__contact-text'>
                                            <a target='_blank' href='#'>Mon-sat, 09am -06pm</a>
                                        </div>
                                    </li>
                                    <li class='d-flex align-items-center'>
                                        <div class='offcanvas__contact-icon mr-15'>
                                            <i class='far fa-phone'></i>
                                        </div>
                                        <div class='offcanvas__contact-text'>
                                            <a href='tel:+919991538679'>+919991538679</a>
                                        </div>
                                    </li>
                                </ul>
                                <div class='header-button mt-4'>
                                    <a href='contact.php' class='theme-btn text-center'>
                                        <span>get A Quote<i class='fa-solid fa-arrow-right-long'></i></span>
                                    </a>
                                </div>
                                <div class='social-icon d-flex align-items-center'>
                                    <a href='https://www.facebook.com/ApricornSolutions/'><i class='fab fa-facebook-f'></i></a>
                                    <a href='https://x.com/apricornsol?mx=2'><i class='fab fa-twitter'></i></a>
                                    <a href='#'><i class='fab fa-youtube'></i></a>
                                    <a href='https://in.linkedin.com/company/apricorn-solutions'><i class='fab fa-linkedin-in'></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='offcanvas__overlay'></div>
            
            <!-- Header Section Start -->
            <header>
                <div id='header-sticky' class='header-1'>
                    <div class='container-fluid'>
                        <div class='mega-menu-wrapper'>
                            <div class='header-main style-2'>
                                <div class='header-left'>
                                    <div class='logo'>
                                        <a href='index.php' class='header-logo'>
                                            <img src='assets/img/webimg/apricron.png' alt='Apricorn Solutions logo' style='width: 120px; height: 50px;'>
                                        </a>
                                    </div>
                                </div>
                                <div class='header-middle'>
                                    <div class='mean__menu-wrapper'>
                                        <div class='main-menu'>
                                            <nav id='mobile-menu'>
                                                <ul>
                                                    <li class='has-dropdown active menu- Website development services in Haryana '>
                                                        <a href='/'>Home</a>
                                                    </li>
                                                    <li>
                                                        <a href='about'>About</a>
                                                    </li>
                                                    <li class='has-dropdown'>
                                                <a href='./service'>
                                                    Services
                                                </a>
                                                <ul class='submenu'>
                                                    <li><a href='./website-development'>Website Development</a></li>
                                                    <li><a href='./app-development'>App Development</a></li>
                                                    <li><a href='./digital-marketing'>Digital Marketing</a></li>
                                                    <li><a href=''./seo'>SEO</a></li>
                                                    <li><a href='./cloudhosting'>Cloud Hosting</a></li>
                                                    <li><a href=''./erpdevelopment'>ERP Development </a></li>
                                                    <li><a href='./softwaredevelopment'>Software Development </a></li>
                                                    <li><a href=''./uiuxdesgin'>UI/UX Desgin </a></li>
                                                    <li><a href='./ecommercedevelopment'>E-Commerce Development </a></li>
                                                </ul>
                                            </li>
                                                    <li>
                                                        <a href='blog'>Blog</a>
                                                    </li>
                                                    <li>
                                                        <a href='contactus'>Contact</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <div class='header-right d-flex justify-content-end align-items-center'>
                                    <a href='#0' class='search-trigger search-icon'><i class='fal fa-search'></i></a>
                                    <div class='header-button ms-4'>
                                        <a href='contactus' class='gt-btn'>
                                            <span>
                                                get A Quote
                                                <i class='fa-solid fa-arrow-right-long'></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div class='header__hamburger d-block d-xl-none my-auto'>
                                        <div class='sidebar__toggle'>
                                            <i class='fas fa-bars'></i>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Search Area Start -->
            <div class='search-wrap'>
                <div class='search-inner'>
                    <i class='fas fa-times search-close' id='search-close'></i>
                    <div class='search-cell'>
                        <form method='get'>
                            <div class='search-field-holder'>
                                <input type='search' class='main-search-input' placeholder='Search...'>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            ";
                echo "<section class='hero-section fix'>
            <div class='hero-wrapper style1'>
                <div class='shape1_2 d-none d-xxl-block'>
                    <img src='assets/img/shape/heroShape1_2.png' alt='development services in haryana'>
                </div>
                <div class='shape1_3'>
                    <a href='contactus.php'>
                        <img class='rotate360' src='assets/img/shape/heroShape1_3.png' alt='web development services in haryana'>
                    </a>
                </div>
                <div class='shape1_4 movingX d-none d-xxl-block'>
                    <img src='assets/img/shape/heroShape1_4.png' alt='app development services in haryana'>
                </div>
                <div class='shape1_5 float-bob-y d-none d-xxl-block'>
                    <img src='assets/img/shape/heroShape1_5.png' alt='software development services in haryana'>
                </div>
                <div class='container-fluid'>
                    <div class='hero-main-container style1 border-radius'>
                        <div class='container-fluid'>
                            <div class='row d-flex align-items-center align-items-xl-start'>
                                <div class='col-xl-6 order-1 order-xl-1'>
                                    <div class='hero-content style1' style='
    padding: 27px;
    margin-top: -79px;
'>
                                        <h6 class='subtitle'>
                                            <img src='assets/img/icon/subtitleIcon1_1.svg' alt='digital services in haryana'>
                                            We are Website and Advertisement Expert
                                        </h6>
                                        <h1 style='margin-bottom: 20px;'>$carouseltext</h1>
                                        <div class='contact-meta'>
                                            <div class='btn-wrapper'>
                                                <a href='contactus' class='gt-btn style4' style='background-color: #5e5ed2;'>
                                                    Get Started <i class='fa-sharp fa-regular fa-arrow-right-long'></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-xl-6 order-2 order-xl-2 justify-content-center'>
                                    <div class='hero-thumb style1'>
                                        <div class='main-thumb'>
                                            <img src='assets/img/webimg/ftone.jpg' style='margin-top: 45px; border-radius: 20px;' alt='Website design services in Haryana'>
                                        </div>
                                        <div class='shape1_1 d-none d-xxl-block'>
                                            <img src='assets/img/shape/heroShape1_1.png' alt='shape'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- SVG Mask -->
                        <svg xmlns='http://www.w3.org/2000/svg' width='0' height='0' style='position: absolute;'>
                            <clipPath id='heroMask2'>
                                <path d='M0 50C0 22.3858 22.3858 0 50 0H1780C1807.61 0 1830 22.3858 1830 50V774C1830 801.614 1807.61 824 1780 824H1042.05C1015.85 824 991.426 810.575 977.326 788.498C947.176 741.292 878.083 741.197 848.055 788.482C834.009 810.601 809.627 824 783.425 824H50C22.3858 824 0 801.614 0 774V50Z' fill='#384BFF' />
                            </clipPath>
                        </svg>
                    </div>
                </div>
            </div>
        </section>";


                echo "
          <section class='service-section space fix'>
        <div class='service-container-wrapper style1'>
            <div class='container-fluid'>
                <div class='title-wrap mb-45'>
                    <div class='section-title'>
                        <div class='subtitle'> <img src='assets/img/icon/arrowLeft.svg' alt='icon'> <span> Our Services
                            </span><img src='assets/img/icon/arrowRight.svg' alt='icon'></div>
                        <h2 class='title'>Better IT & Digital Marketing Solutions For Your Needs

                        </h2>
                    </div>
                    <div class='arrow-btn text-end wow fadeInUp' data-wow-delay='.9s'>
                        <button data-slider-prev='#serviceSliderOne' class='slider-arrow style1'><i
                                class='fa-sharp fa-regular fa-arrow-left-long'></i></button>
                        <button data-slider-next='#serviceSliderOne' class='slider-arrow style1 slider-next'><i
                                class='fa-regular fa-arrow-right-long'></i></button>
                    </div>
                </div>
                


            <div class='row'>
               <div class='slider-area serviceSliderOne'>
                  <div class='swiper gt-slider' id='serviceSliderOne'
                     data-slider-options='{\"loop\": true, \"breakpoints\":{\"0\":{\"slidesPerView\":1},\"576\":{\"slidesPerView\":2,\"centeredSlides\":true},\"768\":{\"slidesPerView\":2},\"992\":{\"slidesPerView\":3},\"1200\":{\"slidesPerView\":4}}}'>
                     <div class='swiper-wrapper'>
                        <div class='swiper-slide'>
                           <div class='service-card style1'>
                              <div class='icon'>
                                 <img src='assets/img/icon/serviceIcon1_1.svg' alt='icon'>
                              </div>
                              <div class='body'>
                                 <h3> <a href='app-development'>Application Development</a> </h3>
                                 <p>

                                    Application development services in India specialize in creating software applications that operate seamlessly across various platforms, including mobile devices and desktops.</p>
                                 <a href='app-development' class='link-btn style1'>Read more <i
                                       class='fa-regular fa-chevrons-right'></i></a>
                              </div>
                           </div>
                        </div>
                        <div class='swiper-slide'>
                           <div class='service-card style1'>
                              <div class='icon'>
                                 <img src='assets/img/icon/serviceIcon1_2.svg' alt='icon'>
                              </div>
                              <div class='body'>
                                 <h3> <a href='ecommercedevelopment'>E-Commerce Website</a> </h3>
                                 <p> e-commerce website is a digital platform for buying and selling products or services online. Many businesses also offer e-commerce services in India to cater to local customers.</p>
                                 <a href='ecommercedevelopment' class='link-btn style1'>Read more <i
                                       class='fa-regular fa-chevrons-right'></i></a>
                              </div>
                           </div>
                        </div>
                        <div class='swiper-slide'>
                           <div class='service-card style1'>
                              <div class='icon'>
                                 <img src='assets/img/icon/serviceIcon1_3.svg' alt='icon'>
                              </div>
                              <div class='body'>
                                 <h3> <a href='digital-marketing'>Digital Marketing</a> </h3>
                                 <p>

                                    Digital marketing involves promoting products, services, or brands through online platforms and digital technologies. It uses the internet to target audiences, including those in India.</p>
                                 <a href='digital-marketing' class='link-btn style1'>Read more <i
                                       class='fa-regular fa-chevrons-right'></i></a>
                              </div>
                           </div>
                        </div>
                        <div class='swiper-slide'>
                           <div class='service-card style1'>
                              <div class='icon'>
                                 <img src='assets/img/icon/serviceIcon1_4.svg' alt='icon'>
                              </div>
                              <div class='body'>
                                 <h3> <a href='website-development'>Website Development</a> </h3>
                                 <p>Website design involves planning and organizing content to create an attractive and functional site. We expert website development services in India, focusing on user experience and customization.</p>
                                 <a href='website-development' class='link-btn style1'>Read more <i
                                       class='fa-regular fa-chevrons-right'></i></a>
                              </div>
                           </div>
                        </div>
                        <div class='swiper-slide'>
                           <div class='service-card style1'>
                              <div class='icon'>
                                 <img src='assets/img/icon/serviceIcon1_1.svg' alt='icon'>
                              </div>
                              <div class='body'>
                                 <h3> <a href='cloudhosting'>Cloud Hosting</a> </h3>
                                 <p>Cloud Hosting uses a network of interconnected servers to host websites and applications. In India, several cloud hosting services provide scalable and reliable solutions.</p>
                                 <a href='cloudhosting' class='link-btn style1'>Read more <i
                                       class='fa-regular fa-chevrons-right'></i></a>
                              </div>
                           </div>
                        </div>
                        <div class='swiper-slide'>
                           <div class='service-card style1'>
                              <div class='icon'>
                                 <img src='assets/img/icon/serviceIcon1_2.svg' alt='icon'>
                              </div>
                              <div class='body'>
                                 <h3> <a href='uiuxdesgin'>UI/UX Desgin</a> </h3>
                                 <p>UI (User Interface) Design focuses on creating visually appealing and functional interfaces. It includes services like button design and layout development, offered in India.</p>
                                 <a href='uiuxdesgin' class='link-btn style1'>Read more <i
                                       class='fa-regular fa-chevrons-right'></i></a>
                              </div>
                           </div>
                        </div>
                        <div class='swiper-slide'>
                           <div class='service-card style1'>
                              <div class='icon'>
                                 <img src='assets/img/icon/serviceIcon1_1.svg' alt='icon'>
                              </div>
                              <div class='body'>
                                 <h3> <a href='erpdevelopment'>ERP Development</a> </h3>
                                 <p>ERP development focuses on creating software that integrates and streamlines business processes. Our ERP services in India enhance operational efficiency across industries.</p>
                                 <a href='erpdevelopment' class='link-btn style1'>Read more <i
                                       class='fa-regular fa-chevrons-right'></i></a>
                              </div>
                           </div>
                        </div>
                        <div class='swiper-slide'>
                           <div class='service-card style1'>
                              <div class='icon'>
                                 <img src='assets/img/icon/serviceIcon1_2.svg' alt='icon'>
                              </div>
                              <div class='body'>
                                 <h3> <a href='softwaredevelopment'>Software Development</a> </h3>
                                 <p>Software development includes designing, creating, testing, and maintaining applications. In India, diverse services cater to businesses' software development needs.</p>
                                 <a href='softwaredevelopment' class='link-btn style1'>Read more <i
                                       class='fa-regular fa-chevrons-right'></i></a>
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
    ";
    
    echo"
    
  <div class='brand-slider-section fix'>
      <div class='brand-slider-container-wrapper style1'>
         <div class='container'>
            <div class='row'>
              <div class='slider-area brandSliderOne'>
                  <div class='swiper gt-slider' id='brandSliderOne'
                     data-slider-options='{'loop': true, 'breakpoints':{'0':{'slidesPerView':1},'576':{'slidesPerView':2,'centeredSlides':true},'768':{'slidesPerView':3},'992':{'slidesPerView':4},'1200':{'slidesPerView':5}}}'>
                     <div class='swiper-wrapper'>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/software-development1.png' alt='software-development'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/web-development1.png' alt='web-development'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/app-development1.png' alt='app-development'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/ui-design1.png' alt='ui/ux-design'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/digital-marketing1.png' alt='digital-marketing'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/seo1.png' alt='SEO'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/ecommerce-development1.png' alt='ecommerce-development'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/software-development1.png' alt='software-development'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/web-development1.png' alt='web-development'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/app-development1.png' alt='app-development'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/ui-design1.png' alt='ui/ux-design'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/digital-marketing1.png' alt='digital-marketing'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/seo1.png' alt='SEO'>
                          </div>
                        </div>
                        <div class='swiper-slide'>
                          <div class='brand-logo'>
                              <img src='assets/img/brand-logo/ecommerce-development1.png' alt='ecommerce-development'>
                          </div>
                        </div>
                        
                       
                     </div>
                  </div>
              </div>
            </div>
         </div>
      </div>
  </div> -->


    ';





                echo ' <section class='project-section space fix'>
                    <div class='project-container-wrapper style1'>
                        <div class='container-fluid'>
                            <div class='section-title title-area  mx-auto mb-10'>
                                <div class='subtitle d-flex justify-content-center'> <img src='assets/img/icon/arrowLeft.svg' alt='icon'>
                                    <span>Connect With our work
                                    </span><img src='assets/img/icon/arrowRight.svg' alt='icon'>
                                </div>
                                <h3 class='title text-center'>Industries We Serve</h3>
                            </div>


 <div class='project-item-wrapper style1'>
           <div class='project-item-card style1 wow fadeInUp' data-wow-delay='.2s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_1.svg' alt='icon'>
                        </div>
                        <h5>E-Commerce</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='.4s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_2.svg' alt='icon'>
                        </div>
                        <h5>HealthCare</h5>
                    </div>
                    <div class='project-item-card style1 active wow fadeInUp' data-wow-delay='.6s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_3.svg' alt='icon'>
                        </div>
                        <h5>Education</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='.8s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_4.svg' alt='icon'>
                        </div>
                        <h5>Real Estate</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='1s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_5.svg' alt='icon'>
                        </div>
                        <h5>Travel and Hospitality</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='.8s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_4.svg' alt='icon'>
                        </div>
                        <h5>Technology</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='1s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_5.svg' alt='icon'>
                        </div>
                        <h5>Food and Beverage</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='.8s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_4.svg' alt='icon'>
                        </div>
                        <h5>Finance</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='1s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_5.svg' alt='icon'>
                        </div>
                        <h5>Fashion and Lifestyle</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='.8s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_4.svg' alt='icon'>
                        </div>
                        <h5>Non-Profit and NGO'S</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='1s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_5.svg' alt='icon'>
                        </div>
                        <h5>Automotive</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='.8s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_4.svg' alt='icon'>
                        </div>
                        <h5>Personal Websites</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='1s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_5.svg' alt='icon'>
                        </div>
                        <h5>Sports and Fitness</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp data-wow-delay='.8s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_4.svg' alt='icon'>
                        </div>
                        <h5>Agriculture</h5>
                    </div>
                    <div class='project-item-card style1 wow fadeInUp' data-wow-delay='1s'>
                        <div class='project-icon'>
                            <img src='assets/img/icon/projectItemIcon1_5.svg' alt='icon'>
                        </div>
                        <h5>Performance Marketing</h5>
                    </div>
                            </div>";



                echo " <div class='project-wrapper style1'>
                                <div class='row gy-5 gx-60'>
                                    <div class='col-xl-5'>
                                        <div class='project-thumb img-custom-anim-left wow fadeInUp' data-wow-delay='.5s'>
                                            <img src='assets/img/home/home3.png' alt='thumb'>
                                        </div>
                                    </div>
                                    <div class='col-xl-7'>
                                        <div class='project-content-wrapper style1'>
                                            <div class='project-content style1'>
                                                <div class='row'>
                                                    <div class='col-xl-9'>
                                                        <div class='project-content-left'>
                                                            <h3>Detailing of our Company</h3>
                                                            <p class='text'>Apricorn Solutions is a leading website development company, specializing in website design, development, digital marketing, and seo optimization. With a team of skilled professionals, we help businesses establish a strong online presence through innovative and result-driven solutions.</p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class='col-xl-3'>
                                                        <!-- <div class='project-content-right'>
                                                <img class='img-custom-anim-right wow fadeInUp' data-wow-delay='.6s'
                                                   src='assets/img/webimg/prt1.png' alt='thumb'>
                                             </div> -->
                                                    </div>
                                                </div>
            
                                                <!-- SVG Mask -->
                                                <svg xmlns='http://www.w3.org/2000/svg width'0' height='0' style='position: absolute;'>
                                                    <clipPath id='projectContentdMask'>
                                                        <path
                                                            d='M0 16C0 7.16344 7.16344 0 16 0H746C754.837 0 762 7.16344 762 16V354C762 362.837 754.837 370 746 370H454.326C432.82 370 412.992 358.378 402.484 339.614L401.681 338.18C379.099 297.856 320.881 298.393 299.048 339.127C288.859 358.136 269.04 370 247.472 370H16C7.16344 370 0 362.837 0 354V16Z' />
                                                    </clipPath>
                                                </svg>
                                            </div>
            
                                            <div class='shape'><a href='project-details.php'><img class='rotate360'
                                                        src='assets/img/shape/projectShape1_1.png' alt='shape'></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>";

                if ($result1->num_rows > 0) {
                    echo "<section class='work-process-section space bg-theme-color2 fix'>
                            <div class='subtitle' style='margin-left: 50px;'>
                                <img src='assets/img/icon/arrowLeft.svg' alt='icon'> 
                                <span> Blog & News </span>
                                <img src='assets/img/icon/arrowRight.svg' alt='icon'>
                            </div>
                            <h3 class='title' style='color:aliceblue; margin-left: 50px;'>Our Website Development Process</h3>
                          </div>
                          <div class='work-process-wrapper style1 space pb-0'>
                            <div class='container-fluid'>
                                <div class='row gy-5'>";

                    // Render steps dynamically
                    while ($row = $result1->fetch_assoc()) {
                        $activeClass = ($row['step_number'] == 2) ? 'active' : ''; // Step 2 ko active class dena
                        echo "<div class='col-xl-3'>
                                <div class='work-process-card style1 $activeClass wow fadeInUp' data-wow-delay='{$row['delay']}'>
                                    <div class='number'>{$row['step_number']}</div>
                                    <h3 class='title'>{$row['title']}</h3>
                                    <p class='text'>{$row['description']}</p>
                                </div>
                              </div>";
                    }

                    echo "      </div>
                            </div>
                          </div>
                        </section>";
                } else {
                    echo "<p>No steps found.</p>";
                }

                echo " <section class='cta-section space pb-0'>
                    <div class='container'>
                        <div class='cta-wrap style1 fix'>
                            <div class='shape'><img src='assets/img/shape/ctaShape1_1.png' alt='shape'></div>
                            <div class='row gy-5'>
                                <div class='col-xl-3'>
                                    <div class='cta-thumb img-custom-anim-left wow fadeInUp' data-wow-delay='.2s'>
                                        <img src='assets/img/webimg/young-man-using-desktop-computer-sitting-in-chair-with-desk-free-vector-removebg-preview.png' alt='thumb'>
                                    </div>
                                </div>
                               <div class='col-xl-6 d-flex align-items-center'>
    <div class='section-title'>
        <div class='subtitle'> 
            <img src='assets/img/icon/arrowLeftWhite.svg' alt='icon'> 
            <span class='text-white'>Contact US</span>
            <img src='assets/img/icon/arrowRightWhite.svg' alt='icon'>
        </div>
        <h3 class='title'>24/7 Expert Support</h3>
    </div>
</div>

                                <div class='col-xl-3 d-flex align-items-center'>
                                    <div class='btn-wrapper'>
                                        <a class='gt-btn style5' href='contactus'>Talk to a Specialist<i
                                                class='fa-sharp fa-regular fa-arrow-right-long'></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>";
                echo "  <section class='testimonial-section space pb-0 fix wow fadeInUp' data-wow-delay='.2s'
                    data-bg-src='assets/img/bg/testimonialBg1_1.png'>
            
                </section>";
                echo "faq";
                echo "<section class='aq-section space pb-0 fix'>
        <div class='container'>
            <div class='faq-wrapper style1'>
                <div class='row gy-5'>
                    <div class='col-xl-6'>
                        <div class='faq-thumb'>
                            <img class='thumb1 img-custom-anim-top wow fadeInUp' data-wow-delay='.2s'
                                src='assets/img/home/home-7.jpg' alt='thumb'>
                        </div>
                    </div>
                    <div class='col-xl-6'>
                        <div class='section-title mxw-560'>
                            <div class='subtitle'> 
                                <img src='assets/img/icon/arrowLeft.svg' alt='icon'> 
                                <span> Faq </span>
                                <img src='assets/img/icon/arrowRight.svg' alt='icon'>
                            </div>
                            <h3 class='title'>Frequently Asked Questions (FAQ)</h3>
                        </div>
                        <div class='faq-content style1'>
                            <div class='faq-accordion'>
                                <div class='accordion' id='accordion'>";

                // Fetch FAQs from database for the specific page_id


                if ($result2->num_rows > 0) {
                    $count = 1;
                    while ($row = $result2->fetch_assoc()) {
                        $expanded = ($count === 1) ? "true" : "false";
                        $show = ($count === 1) ? "show" : "";

                        echo "<div class='accordion-item mb-3 wow fadeInUp' data-wow-delay='{$row['delay']}'>
                <h5 class='accordion-header'>
                    <button class='accordion-button $show' type='button' data-bs-toggle='collapse'
                        data-bs-target='#faq{$row['id']}' aria-expanded='$expanded' aria-controls='faq{$row['id']}'>
                        {$count}. {$row['question']}
                    </button>
                </h5>
                <div id='faq{$row['id']}' class='accordion-collapse collapse $show' data-bs-parent='#accordion'>
                    <div class='accordion-body'>
                        {$row['answer']}
                    </div>
                </div>
              </div>";

                        $count++;
                    }
                } else {
                    echo "<p>No FAQs available for this page.</p>";
                }

                echo "                </div>
                </div>
            </div>
        </div>
    </section>";

                echo " <script>
                    document.querySelectorAll('.link-btn.style1').forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            const bodyElement = this.closest('.service-card').querySelector('.body');
                            bodyElement.classList.toggle('expanded');
            
                            if (bodyElement.classList.contains('expanded')) {
                                this.innerHTML = 'Read less <i class='fa-regular fa-chevrons-up'></i>';
                            } else {
                                this.innerHTML = 'Read more <i class='fa-regular fa-chevrons-right'></i>';
                            }
                        });
                    });
                </script>";
                echo "
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
                                console.error(`Element with ID '$contentId' not found.`);
                            }
                        });
                    });
                </script>
                ";
                echo '<footer class="footer-area">
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
                                <p class="about-text"> Apricorn Solution Technology is an information technology company specializing in providing innovative and tailored IT solutions to meet the diverse needs of businesses.</p>
                                <div class="gt-social style2">
                                    <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                                    <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                                    <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-12">
                        <div class="widget widget_nav_menu footer-widget wow fadeInUp" data-wow-delay="1s">
                            <h3 class="widget_title">Quick Links</h3>
                            <div class="menu-all-pages-container">
                                <ul class="menu">
                                    <li><a href="about.php"><i class="fa-solid fa-chevrons-right"></i> About us</a></li>
                                    <li><a href="service.php"><i class="fa-solid fa-chevrons-right"></i>Our Services</a></li>
                                    <li><a href="news.php"><i class="fa-solid fa-chevrons-right"></i>Our Blogs</a></li>
                                    <li><a href="faq.php"><i class="fa-solid fa-chevrons-right"></i>FAQ’S</a></li>
                                    <li><a href="contactus.php"><i class="fa-solid fa-chevrons-right"></i>Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>';
                echo ' <div class="col-xl-4 col-md-6 col-12">
                        <div class="widget footer-widget wow fadeInUp" data-wow-delay="1.3s">
                            <h3 class="widget_title">Recent Posts</h3>
                            <div class="recent-post-wrap">';
                if ($result3->num_rows > 0) {
                    while ($row = $result3->fetch_assoc()) {
                        echo '
                    <div class="recent-post">
                                    <div class="media-img">
                                        <a href="news-details.php?id=' . $row['id'] . '">
                    <img src="' . $base_url . '/admin/uploads/' . $row['image'] . '" alt="thumb">

                </a>
                                    </div>
                                    <div class="media-body">
                                        <div class="recent-post-meta">
                                           <a href="news-details.php?id=' . $row['id'] . '">
                        <img src="assets/img/icon/calendarIcon.svg" alt="icon">' . date("jS F, Y", strtotime($row['created_at'])) . '
                    </a>
                                        </div>
                                        <h4 class="post-title">
                    <a class="text-inherit" href="news-details.php?id=' . $row['id'] . '">' . $row['title'] . '</a>
                </h4>
                                    </div>
                                </div>
                                
                    ';
                    }
                }

                echo ' 
                 
                               
                            </div>
                        </div>
                    </div>';

                echo '    <div class="col-xl-3 col-md-6 col-12">
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
                                    <button type="submit" id="submitButton" disabled=""><i class="fa-regular fa-arrow-right-long"></i></button>
                                </div>
                                <form id="termsForm">
                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="agree" id="agreeCheckbox">
                                        <span class="checkmark"></span>
                                        I agree to the <a class="text-underline" href="contactus.php" target="_blank">Privacy Policy.</a>
                                    </label><br>
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
                        <i class="fal fa-copyright"></i> All Copyright 2025 by <a href="index.php">apricornsolutions</a>
                    </p>
                </div>
                <div class="layout-link wow fadeInUp" data-wow-delay=".6s">
                    <div class="link-wrapper">
                        <a href="#">Terms &amp; Condition</a>
                        <a href="#">Privacy Policy</a>
                        <a href="#">Site Map</a>
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



</script>

</body>

';
            } else {
                // Debug: Check if no results are found
                header("HTTP/1.0 404 Not Found"); // Send a 404 header
                include('404.html'); // Redirect to your 404 error page
                exit; // Stop further script execution
            }
        } else {
            // Debug: If the database connection fails
            echo "Database connection failed.";
        }
    } else {
        echo "Invalid request.";
    }


    $conn->close(); ?>

</html>