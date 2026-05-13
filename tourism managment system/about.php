<?php
// Database connection
include('./includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>About Us - Tourism Management System</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap for responsive components -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" />

    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css//style.css" />
</head>
<style>
    /* About Section Styling */
.about-content {
  padding: 60px 0;
  background: #f9f9f9;
  font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  color: #444;
}

.about-content h2.page-title {
  font-size: 32px;
  font-weight: 700;
  color: #2c3e50;
  margin-bottom: 20px;
  position: relative;
}

.about-content h2.page-title::after {
  content: "";
  width: 60px;
  height: 3px;
  background: #ff6600;
  display: block;
  margin-top: 10px;
}

.about-content p {
  font-size: 16px;
  line-height: 1.8;
  margin-bottom: 15px;
  color: #555;
}

.about-content img {
  border-radius: 10px;
  box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.15);
  transition: transform 0.4s ease;
}

.about-content img:hover {
  transform: scale(1.05);
}

/* Vision & Mission */
.about-content h3 {
  font-size: 24px;
  font-weight: 600;
  color: #ff6600;
  margin-bottom: 15px;
  position: relative;
}

.about-content h3::before {
  content: "★";
  margin-right: 10px;
  color: #2c3e50;
}

.about-content .row div p {
  background: #fff;
  padding: 15px 20px;
  border-radius: 8px;
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
  transition: all 0.4s ease;
}

.about-content .row div p:hover {
  background: #ff6600;
  color: #fff;
  transform: translateY(-5px);
}

/* Responsive */
@media (max-width: 768px) {
  .about-content {
    padding: 40px 20px;
  }

  .about-content h2.page-title {
    font-size: 26px;
  }

  .about-content h3 {
    font-size: 20px;
  }

  .about-content img {
    margin-top: 20px;
    width: 100%;
  }
}

</style>
<body>

    <!-- Header Section -->
    <?php include('includes/header.php'); ?>
    <!-- Banner Section -->
    <div class="banner-3">
        <div class="container">
            <h1 class="wow zoomIn animated" data-wow-delay=".5s">About us</h1>
        </div>
    </div>

   

    <!-- About Content -->
    <section class="about-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="page-title">Welcome to Tourism Management System</h2>
                    <p>
                        Welcome to Tourism Management System!!!
                        Since then, our courteous and committed team members have always ensured a pleasant and enjoyable tour for the clients. This arduous effort has enabled TMS to be recognized as a dependable Travel Solutions provider with We have got packages to suit the discerning traveler's budget and savor. Book your dream vacation online. Supported quality and proposals of our travel consultants, we have a tendency to welcome you to decide on from holidays packages and customize them according to your plan.
                    </p>
                    <p>
                        At Tourism Management System, we pride ourselves on delivering exceptional travel experiences that exceed expectations. Our team of dedicated professionals works tirelessly to ensure every aspect of your journey is seamless and memorable.
                    </p>
                    <p>
                        With years of experience in the tourism industry, we understand what makes a trip truly special. From selecting the perfect destination to arranging comfortable accommodations and exciting activities, we handle every detail so you can focus on creating wonderful memories.
                    </p>
                </div>

                <div class="col-md-4">
                    <img src="https://images.unsplash.com/photo-1501555088652-021faa106b9b?w=600" alt="About Us Image" class="img-responsive" />
                </div>
            </div>

            <hr />

            <div class="row">
                <div class="col-md-6">
                    <h3>Our Vision</h3>
                    <p>To be the leading provider of innovative and sustainable tourism solutions globally, enhancing cultural exchange and preserving natural environments for future generations.</p>
                </div>
                <div class="col-md-6">
                    <h3>Our Mission</h3>
                    <p>To deliver exceptional travel experiences by combining passion, expertise, and technology, ensuring every journey is memorable and meaningful.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <div class="routes">
        <div class="container">
            <div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
                <div class="rou-left">
                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i></a>
                </div>
                <div class="rou-rgt">
                    <h3>80,000</h3>
                    <p>Enquiries</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-4 routes-left">
                <div class="rou-left">
                    <a href="#"><i class="fa fa-user"></i></a>
                </div>
                <div class="rou-rgt">
                    <h3>1,900</h3>
                    <p>Registered Users</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-4 routes-left wow fadeInRight animated" data-wow-delay=".5s">
                <div class="rou-left">
                    <a href="#"><i class="fa fa-ticket"></i></a>
                </div>
                <div class="rou-rgt">
                    <h3>7,00,00,000+</h3>
                    <p>Bookings</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('./includes/footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="./js/main.js"></script>

    <script>
        new WOW().init();
    </script>
</body>

</html>