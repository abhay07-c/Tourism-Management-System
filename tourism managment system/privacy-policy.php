<?php
// Database connection
include('./includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tourism Management System - Privacy Policy</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" />
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />
 
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css//style.css"/>
</head>

<body>
    <?php include('./includes/header.php'); ?>
  
    <div class="banner-3">
        <div class="container">
            <h1 class="wow zoomIn animated" data-wow-delay=".5s">Privacy Policy</h1>
        </div>
    </div>

    <!-- Privacy Policy Section -->
    <section class="privacy-policy-section">
        <div class="container">
            <div class="policy-card">
                <h3><i class="fas fa-info-circle"></i> Information We Collect</h3>
                <p>We may collect personal information when you visit our website, register, place an order, or interact with us.</p>
                <ul>
                    <li>Name, email address, phone number</li>
                    <li>Payment details (processed securely via third-party gateways)</li>
                    <li>IP address, browser type, and usage data</li>
                </ul>
            </div>

            <div class="policy-card">
                <h3><i class="fas fa-shield-alt"></i> How We Use Your Information</h3>
                <p>We use your information to provide and improve our services, process transactions, and communicate with you.</p>
                <ul>
                    <li>To process bookings and payments</li>
                    <li>To send updates, offers, and newsletters</li>
                    <li>To personalize your experience on our site</li>
                </ul>
            </div>

            <div class="policy-card">
                <h3><i class="fas fa-lock"></i> Data Protection</h3>
                <p>We implement industry-standard security measures to protect your data from unauthorized access or disclosure.</p>
            </div>

            <div class="policy-card">
                <h3><i class="fas fa-cookie-bite"></i> Cookies</h3>
                <p>Our website uses cookies to enhance user experience. You can choose to disable cookies through your browser settings.</p>
            </div>

            <div class="policy-card contact-policy">
                <h3><i class="fas fa-envelope"></i> Contact Us</h3>
                <div class="contact-info">
                    <p><i class="fas fa-map-marker-alt"></i> 123 Travel Street, City, Country</p>
                    <p><i class="fas fa-phone"></i> +1 234 567 890</p>
                    <p><i class="fas fa-envelope"></i> privacy@travelwebsite.com</p>
                </div>
            </div>
        </div>
    </section>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="./js/main.js"></script>

    <script>
        new WOW().init();
    </script>
    
    <!-- Footer -->
    <?php include('./includes/footer.php')?>
</body>
</html>