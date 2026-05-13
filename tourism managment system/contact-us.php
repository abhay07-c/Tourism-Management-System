<?php
// Database connection
include('./includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contact Us - Tourism Management System</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css//style.css" />
    
    <!-- Font Awesome 7 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />
</head>
<style>
    /* Contact Section */
.contact-info {
    text-align: center;
    margin-top: 20px;
}

.contact-item {
    background: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.contact-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.12);
}

.contact-item i {
    color: #007bff;
    margin-bottom: 10px;
    display: block;
}

.contact-item h4 {
    font-size: 18px;
    margin-bottom: 8px;
    color: #333;
    font-weight: 600;
}

.contact-item p {
    margin: 0;
    color: #555;
    font-size: 15px;
}

/* Social Links */
.social-links {
    margin-top: 25px;
}

.social-links h4 {
    margin-bottom: 10px;
    font-weight: 600;
}

.social-links a {
    display: inline-block;
    margin: 0 8px;
    font-size: 20px;
    color: #555;
    transition: all 0.3s;
}

.social-links a:hover {
    color: #007bff;
    transform: scale(1.2);
}

/* Map */
.map iframe {
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

</style>
<body>

    <!-- Header -->
    <?php include('includes/header.php'); ?>

    <div class="banner-3">
        <div class="container">
            <h1 class="wow zoomIn animated" data-wow-delay=".5s">Contact Us</h1>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Contact Us</li>
        </ol>
    </div>

    <!-- Contact Info Only -->
    <section class="contact-content">
        <div class="container">
            <div class="row">
                <!-- Contact Information -->
                <div class="col-md-12">
                    <div class="contact-info">
                        <h2 class="page-title">Get In Touch With Us</h2>
                        <p>Have questions about our travel packages or need assistance with your booking? Our friendly team is here to help you!</p>
                        
                        <div class="row">
                            <div class="col-md-3 contact-item">
                                <i class="fa fa-map-marker fa-2x"></i>
                                <h4>Our Location</h4>
                                <p>123 Travel Street, Tourism City<br>TC 12345</p>
                            </div>
                            
                            <div class="col-md-3 contact-item">
                                <i class="fa fa-phone fa-2x"></i>
                                <h4>Phone</h4>
                                <p>+91 7573860892<br>+1 (555) 987-6543</p>
                            </div>
                            
                            <div class="col-md-3 contact-item">
                                <i class="fa fa-envelope fa-2x"></i>
                                <h4>Email</h4>
                                <p>tms@tourism.com<br>support@tourism.com</p>
                            </div>
                            
                          
                </div>
            </div>
            
            <!-- Map -->
            <div class="row" style="margin-top:40px;">
                <div class="col-md-12">
                    <h3>Find Us On Map</h3>
                    <div class="map">
                       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3711.918687451935!2d70.45223837509486!3d21.510904680261817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395801eb4c7962dd%3A0x56f6243b62fa1459!2sPatel%20Kelavani%20Mandal%20College%20of%20Technology!5e0!3m2!1sen!2sin!4v1758559976673!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include('./includes/footer.php'); ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="./js/main.js"></script>
    <script>
        new WOW().init();
    </script>
</body>

</html>
