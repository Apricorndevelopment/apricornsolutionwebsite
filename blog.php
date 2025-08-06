<?php
include "./admin/db_connect.php";
// echo "Connected successfully!";



// Fetch data from 'addedblogs' table
$result = $conn->query("SELECT * FROM addedblogs ORDER BY created_at DESC");

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ex-coders">
    <meta name="description" content="Apricorn solutions - IT Solution & Technology ">
    <!-- ======== Page title ============ -->
    <title>Apricorn solutions </title>
    <style>
        .news-section {
            padding: 50px 0;
            background-color: #f8f9fa;
        }

        .news-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .news-image img {
            width: 100%;
            height: auto;
        }

        .post-date {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 50%;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }

        .news-content {
            padding: 20px;
        }

        .news-title a {
            color: #333;
            text-decoration: none;
        }

        .news-title a:hover {
            text-decoration: underline;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <!-- Footer Area   S T A R T -->
    <?php
    include 'header.php';
    ?>
    <!--<< Breadcrumb Section Start >>-->
    <div class="breadcrumb-wrapper bg-cover" style="background-image: url('assets/img/webimg/service.jpg');">
        <div class="border-shape">
            <img src="assets/img/element.png" alt="shape-img">
        </div>
        <div class="line-shape">
            <img src="assets/img/line-element.png" alt="shape-img">
        </div>
        <div class="container">
            <div class="page-heading">
                <h1 class="wow fadeInUp" data-wow-delay=".3s">Apricorn Solution</h1>
                <ul class="breadcrumb-items wow fadeInUp" data-wow-delay=".5s">
                    <li>
                        <a href="index.php">
                            Home
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-chevron-right"></i>
                    </li>
                    <li>
                        Blog Grid
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- News Section Start -->

    <section class="news-section">
        <div class="container">
            <div class="row">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="news-card">
                            <div class="news-image position-relative">
                                <img src="admin/uploads/<?php echo $row['image']; ?>" alt="Blog Image">
                               
                                <!--<div class="post-date">-->
                                <!--    <h3>-->
                                <!--        <?php echo date('d', strtotime($row['created_at'])); ?> <br>-->
                                <!--        <span><?php echo date('M', strtotime($row['created_at'])); ?></span>-->
                                <!--    </h3>-->
                                <!--</div>-->
                            </div>
                            <div class="news-content">
                                <ul class="list-inline mb-2">
                                    <li class="list-inline-item">
                                        <i class="far fa-user"></i> By Admin
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-tag"></i> <?php echo $row['category']; ?>
                                    </li>
                                </ul>
                                <h3 class="news-title">
                                    <a href="blogdetails?slug=<?php echo urlencode($row['slug']); ?>">
                                        <?php echo htmlspecialchars($row['title']); ?>
                                    </a>

                                </h3>
                                <!--<a href="blogdetails?slug=<?php echo urlencode($row['slug']); ?>" class="btn btn-primary mt-3">-->
                                <!--    Read More-->
                                <!--    <i class="fas fa-arrow-right"></i>-->
                                <!--</a>-->
                                <a href="blogdetails?slug=<?php echo urlencode($row['slug']); ?>" class="btn btn-primary mt-3">
    Read More
    <i class="fas fa-arrow-right"></i>
</a>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <?php
    include 'footer.php';
    ?>