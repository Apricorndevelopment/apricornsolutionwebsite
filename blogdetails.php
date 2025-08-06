<?php
include "./admin/db_connect.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Validate and get blog slug
if (!isset($_GET['slug']) || empty($_GET['slug'])) {
    die("Invalid Blog Slug");
}
$blogSlug = $_GET['slug'];
$stmt = $conn->prepare("SELECT * FROM addedblogs WHERE slug = ?");
$stmt->bind_param("s", $blogSlug);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Blog not found");
}
$blog = $result->fetch_assoc();

// Fetch FAQs related to this blog
$faq_stmt = $conn->prepare("SELECT * FROM addblogfaq WHERE blog_id = ?");
$faq_stmt->bind_param("i", $blog['id']);
$faq_stmt->execute();
$faq_result = $faq_stmt->get_result();
$faqs = [];
if ($faq_result->num_rows > 0) {
    while ($row = $faq_result->fetch_assoc()) {
        $faqs[] = $row;
    }
}

// Fetch categories
$categoriesResult = $conn->query("SELECT DISTINCT category FROM addedblogs");
if (!$categoriesResult) {
    die("Failed to fetch categories: " . $conn->error);
}

// Fetch recent blogs (excluding current blog)
$recent_blogs = $conn->query("SELECT * FROM addedblogs WHERE id != " . $blog['id'] . " ORDER BY created_at DESC LIMIT 3");
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$canonical_url = 'https://www.apricornsolutions.com/blogdetails.php?slug=' . urlencode($slug);

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta name="author" content="Apricorn solutions">-->
    <meta name="author" content="Apricorn Solutions">
    <meta name="description" content="<?php echo ($blog['description']); ?>">
    <meta name="keywords" content="<?php echo ($blog['keywords']); ?>">
    <meta name="focus_keywords" content="<?php echo ($blog['focus_keywords']); ?>">
    <meta name="icbm" content="<?php echo ($blog['icbm']); ?>">
    <meta name="geo_region" content="<?php echo ($blog['geo_region']); ?>">
    <meta name="geo_placename" content="<?php echo ($blog['geo_placename']); ?>">
    <meta name="geo_position" content="<?php echo ($blog['geo_position']); ?>">
    <meta name="canonical" content="<?php echo ($blog['canonical']); ?>">
    <meta name="schema" content="<?php echo ($blog['schema']); ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo $canonical_url; ?>" />

    <!-- ======== Page title ============ -->
    <title><?php echo $blog['title']; ?></title>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .tagcloud {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 0;
            padding: 0;
        }

        .tagcloud a {
            display: inline-block;
            padding: 5px 10px;
            margin: 5px;
            background-color: #f0f0f0;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .tagcloud a:hover {
            background-color: #3C72FC;
            color: white;
        }

        .editor-content {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        p {
            margin-bottom: 16px;
        }

        strong {
            font-weight: bold;
        }

        em {
            font-style: italic;
        }

        /* FAQ Accordion Styles */
        .faq-section {
            margin: 40px 0;
        }

        .faq-section h3 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
        }

        .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
            color: #3C72FC;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 0, 0, .125);
        }

        .accordion-body {
            padding: 20px;
            background-color: #f8f9fa;
        }

        /* Sidebar Wrapper */
        .main-sidebar {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }
    </style>
    <style>
        /* Sidebar Wrapper */
        .main-sidebar {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        /* Heading */
        .main-sidebar h2 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 25px;
            color: #333;
        }

        .main-sidebar .gradient-word {
            background: linear-gradient(90deg, #5a00ff, #ff007a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Form Wrapper */
        .elementor-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Form Fields */
        .elementor-form .elementor-field-group {
            width: 100%;
        }

        .elementor-select-wrapper {
            position: relative;
        }

        .elementor-select-wrapper select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            appearance: none;
            background-color: #f9f9f9;
        }

        /* Custom dropdown caret */
        .select-caret-down-wrapper {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Range Input */
        input[type="range"] {
            accent-color: #5a00ff;
            margin-top: 10px;
        }

        #pageCount {
            font-weight: 600;
            color: #5a00ff;
        }

        /* Text & Tel Inputs */
        input[type="tel"] {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            font-size: 15px;
        }

        /* Submit Button */
        .elementor-button {
            background: linear-gradient(90deg, #5a00ff, #ff007a);
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            text-align: center;
        }

        .elementor-button:hover {
            background: linear-gradient(90deg, #4a00d0, #c70039);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-sidebar {
                padding: 20px;
            }

            .main-sidebar h2 {
                font-size: 20px;
            }

            .elementor-button {
                width: 100%;
            }
        }

        @media (max-width: 767px) {
            .news-details-area .blog-post-details .single-blog-post .post-featured-thumb {
                height: 227px;
                width: 397px;
            }
        }
    </style>
    <style>
        /* Recent Blogs Section */
        .recent-blogs-section {
            margin-top: 50px;
            padding: 30px 0;
            background-color: #f8f9fa;
        }

        .recent-blogs-title {
            font-size: 28px;
            margin-bottom: 30px;
            color: #333;
            text-align: center;
            font-weight: 700;
        }

        .recent-blog-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
            background: #fff;
        }

        .recent-blog-card:hover {
            transform: translateY(-5px);
        }

        .recent-blog-img {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }

        .recent-blog-body {
            padding: 20px;
        }

        .recent-blog-title {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .recent-blog-meta {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .recent-blog-excerpt {
            font-size: 15px;
            color: #555;
            margin-bottom: 15px;
        }

        .read-more-btn {
            color: #3C72FC;
            font-weight: 600;
            text-decoration: none;
        }

        .read-more-btn:hover {
            text-decoration: underline;
        }
    </style>
    <!-- header Area   S T A R T -->
    <?php
    include 'header.php';
    ?>


    <!-- Blog Details -->
    <section class="news-standard fix section-padding">
        <div class="container">
            <div class="news-details-area">
                <div class="row g-5">
                    <div class="col-12 col-lg-8">
                        <div class="blog-post-details">
                            <div class="single-blog-post">
                                <!-- Blog Image -->
                                <div class="post-featured-thumb bg-cover" id="img" style="margin-top: -145px; background-image: url('admin/uploads/<?php echo htmlspecialchars($blog['image']); ?>');"></div>

                                <div class="post-content">
                                    <!-- Blog Meta Information -->
                                    <ul class="post-list d-flex align-items-center">
                                        <li>
                                            <i class="fa-regular fa-user"></i>
                                            By Admin
                                        </li>

                                        <li>
                                            <i class="fa-solid fa-tag"></i>
                                            <?php echo htmlspecialchars($blog['category']); ?>
                                        </li>
                                    </ul>

                                    <!-- Blog Title -->
                                    <h1><?php echo htmlspecialchars($blog['title']); ?></h1>

                                    <!-- Blog Content -->
                                    <p class="mb-3"><?php echo ($blog['content']); ?></p>
                                </div>
                            </div>

                            <!-- FAQ Section -->
                            <?php if (!empty($faqs)): ?>
                                <div class="faq-section">
                                    <h3>Frequently Asked Questions</h3>
                                    <div class="accordion" id="faqAccordion">
                                        <?php foreach ($faqs as $index => $faq): ?>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                                                    <button class="accordion-button <?php echo $index === 0 ? '' : 'collapsed'; ?>"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse<?php echo $index; ?>"
                                                        aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                                                        aria-controls="collapse<?php echo $index; ?>">
                                                        <?php echo htmlspecialchars($faq['question']); ?>
                                                    </button>
                                                </h2>
                                                <div id="collapse<?php echo $index; ?>"
                                                    class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>"
                                                    aria-labelledby="heading<?php echo $index; ?>"
                                                    data-bs-parent="#faqAccordion">
                                                    <div class="accordion-body">
                                                        <?php echo nl2br(htmlspecialchars($faq['answer'])); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Categories Section -->
                            <div class="row tag-share-wrap mt-4 mb-5">
                                <div class="col-lg-8 col-12">
                                    <div class="tagcloud">
                                        <?php while ($category = $categoriesResult->fetch_assoc()) { ?>
                                            <a href="blog?category=<?php echo urlencode($category['category']); ?>"><?php echo htmlspecialchars($category['category']); ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mt-3 mt-lg-0 text-lg-end">
                                    <div class="social-share">
                                        <span class="me-3">Share:</span>
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-12 col-lg-4">
                        <div class="main-sidebar">
                            <div
                                class="elementor-element elementor-element-48eb3f5 e-con-full e-flex e-con e-child"
                                data-id="48eb3f5"
                                data-element_type="container">
                                <div
                                    class="elementor-element elementor-element-fd6e4a1 elementor-widget elementor-widget-heading"
                                    data-id="fd6e4a1"
                                    data-element_type="widget"
                                    data-widget_type="heading.default">
                                    <div class="elementor-widget-container">
                                        <h2 class="elementor-heading-title elementor-size-default">
                                            Calculate Cost Of
                                            <span class="gradient-word">Development</span>
                                        </h2>
                                    </div>
                                </div>

                                <div
                                    class="elementor-element elementor-element-0a0599f elementor-mobile-button-align-stretch elementor-widget__width-initial elementor-widget-mobile__width-initial elementor-button-align-stretch elementor-widget elementor-widget-form"
                                    data-id="0a0599f"
                                    data-element_type="widget"
                                    data-settings='{"step_next_label":"Next","step_previous_label":"Previous","button_width":"100","step_type":"number_text","step_icon_shape":"circle"}'
                                    data-widget_type="form.default">
                                    <div class="elementor-widget-container">
                                        <form
                                            id="quoteForm"
                                            class="elementor-form"
                                            method="post"
                                            name="Form doc">
                                            <input type="hidden" name="post_id" value="264" />
                                            <input type="hidden" name="form_id" value="0a0599f" />
                                            <input type="hidden" name="referer_title" value="Home - RankVed" />
                                            <input type="hidden" name="queried_id" value="264" />

                                            <div class="elementor-form-fields-wrapper elementor-labels-">
                                                <!-- Project Type -->
                                                <div
                                                    class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-name elementor-col-100 elementor-field-required">
                                                    <label
                                                        for="projectType"
                                                        class="elementor-field-label elementor-screen-only">
                                                        Project Type
                                                    </label>
                                                    <div class="elementor-field elementor-select-wrapper remove-before">
                                                        <div class="select-caret-down-wrapper">
                                                            <!-- caret SVG… -->
                                                        </div>
                                                        <select
                                                            name="projectType"
                                                            id="projectType"
                                                            class="elementor-field-textual elementor-size-sm"
                                                            style="color: black;
                      required
                    >
                      <option value="">Project type</option>
                      <option value=" Business Website">Business Website</option>
                                                            <option value="Healthcare website">
                                                                Healthcare website
                                                            </option>
                                                            <option value="Landing page">Landing page</option>
                                                            <option value="NGO website">NGO website</option>
                                                            <option value="Educational website">
                                                                Educational website
                                                            </option>
                                                            <option value="E commerce website">
                                                                E commerce website
                                                            </option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Number of Pages -->
                                                <div
                                                    class="elementor-field-type-html elementor-field-group elementor-column elementor-field-group-tel elementor-col-100">
                                                    <div style="margin-bottom: -15px;">
                                                        <label
                                                            for="pageRange"
                                                            style="font-weight: bold; display: block;">
                                                            Approx. Number of Pages:
                                                            <span id="pageCount">5</span>
                                                        </label>
                                                        <input
                                                            type="range"
                                                            id="pageRange"
                                                            name="numberOfPages"
                                                            min="1"
                                                            max="50"
                                                            value="5"
                                                            oninput="document.getElementById('pageCount').innerText = this.value" />
                                                    </div>
                                                </div>

                                                <!-- Project Features -->
                                                <div
                                                    class="elementor-field-type-select elementor-field-group elementor-column elementor-field-group-field_91f9434 elementor-col-100 elementor-field-required">
                                                    <label
                                                        for="features"
                                                        class="elementor-field-label elementor-screen-only">
                                                        Project Features
                                                    </label>
                                                    <div class="elementor-field elementor-select-wrapper remove-before">
                                                        <div class="select-caret-down-wrapper">
                                                            <!-- caret SVG… -->
                                                        </div>
                                                        <select
                                                            name="features"
                                                            id="features"
                                                            class="elementor-field-textual elementor-size-sm"
                                                            style="color: black;
                      required
                    >
                      <option value="">Additional Services</option>
                      <option value=" Chat Support / Chatbot">
                                                            Chat Support / Chatbot
                                                            </option>
                                                            <option value="SEO Optimization">
                                                                SEO Optimization
                                                            </option>
                                                            <option value="Analytics & Tracking">
                                                                Analytics &amp; Tracking
                                                            </option>
                                                            <option value="API Integration">API Integration</option>
                                                            <option value="Booking System">Booking System</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- (Optional) User's WhatsApp Number -->
                                                <div
                                                    class="elementor-field-type-tel elementor-field-group elementor-column elementor-field-group-field_487753f elementor-col-100 elementor-field-required">
                                                    <label
                                                        for="userWhatsApp"
                                                        class="elementor-field-label elementor-screen-only">
                                                        Enter your WhatsApp Number*
                                                    </label>
                                                    <input
                                                        size="1"
                                                        type="tel"
                                                        name="userWhatsApp"
                                                        id="userWhatsApp"
                                                        class="elementor-field elementor-size-sm elementor-field-textual"
                                                        placeholder="Enter your WhatsApp Number*"
                                                        pattern="[0-9()+\- ]+"
                                                        style="color: black;
                    title=" Only numbers and phone characters are accepted." />
                                                </div>

                                                <!-- Submit -->
                                                <div
                                                    class="elementor-field-group elementor-column elementor-field-type-submit elementor-col-100 e-form__buttons">
                                                    <button
                                                        class="elementor-button elementor-size-sm"
                                                        type="submit"
                                                        id="getQuoteBtn">
                                                        <span class="elementor-button-content-wrapper">
                                                            <span class="elementor-button-text">
                                                                Get quote on WhatsApp
                                                            </span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <!-- Recent Blogs Section -->
    <section class="recent-blogs-section">
        <div class="container">
            <h2 class="recent-blogs-title">Recent Blogs</h2>
            <div class="row">
                <?php if ($recent_blogs->num_rows > 0): ?>
                    <?php while ($recent_blog = $recent_blogs->fetch_assoc()): ?>
                        <div class="col-md-4">
                            <div class="recent-blog-card">
                                <img src="admin/uploads/<?php echo htmlspecialchars($recent_blog['image']); ?>" alt="<?php echo htmlspecialchars($recent_blog['title']); ?>" class="recent-blog-img">
                                <div class="recent-blog-body">
                                    <div class="recent-blog-meta">
                                        <span><i class="fa-regular fa-calendar"></i> <?php echo date("M j, Y", strtotime($recent_blog['created_at'])); ?></span>
                                    </div>
                                    <h3 class="recent-blog-title"><?php echo htmlspecialchars($recent_blog['title']); ?></h3>
                                    <p class="recent-blog-excerpt"><?php echo substr(strip_tags($recent_blog['content']), 0, 100); ?>...</p>
                                    <a href="blogdetails.php?slug=<?php echo urlencode($recent_blog['slug']); ?>" class="read-more-btn">Read More →</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center">No recent blogs found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script>
        document
            .getElementById('quoteForm')
            .addEventListener('submit', function(e) {
                e.preventDefault();

                const projectType = document.getElementById('projectType').value;
                const pages = document.getElementById('pageRange').value;
                const features = document.getElementById('features').value;

                // Optional: capture user’s own WhatsApp if needed
                const userNumber = document.getElementById('userWhatsApp').value || 'not provided';

                // Build the WhatsApp message
                const message =
                    '*New Quote Request*%0A' +
                    'Project Type: ' + projectType + '%0A' +
                    'Pages: ' + pages + '%0A' +
                    'Features: ' + features + '%0A' +
                    'User Phone: ' + userNumber;

                // Fixed recipient
                const whatsappNumber = '918950943948'; // country code +91, no plus
                const waUrl = `https://wa.me/${whatsappNumber}?text=${message}`;

                window.open(waUrl, '_blank');
            });
    </script>

    <script>
        CKEDITOR.replace('description');
        CKEDITOR.replace('content');

        document.getElementById('blogForm').addEventListener('submit', function(e) {
            const content = CKEDITOR.instances['content'].getData().trim();
            if (content === "") {
                e.preventDefault();
                alert("Content cannot be empty!");
            }
        });
    </script>



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
                            <a href="#">Terms &amp; Condition </a>
                            <a href="#">Privacy Policy</a>
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
    <!--<script src="assets/js/jquery.nice-select.min.js"></script>-->
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