<?php
// Database connection
include('./includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tourism Management System</title>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    
    <!-- Bootstrap for responsive components -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" />
    
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css//style.css" />
    
    <!-- Font Awesome 7 icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />
</head>

<body>

    <!-- Header -->
    <?php include('includes/header.php'); ?>
    
    <div class="cor">
        <!-- Carousel Start -->
        <div id="tourCarousel" class="carousel slide" data-ride="carousel" data-interval="5000" style="margin-bottom: 40px;">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#tourCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#tourCarousel" data-slide-to="1"></li>
                <li data-target="#tourCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1600"
                        alt="Beautiful Beach" class="img-responsive center-block" />
                    <div class="carousel-caption">
                        <h3>Explore Beautiful Beaches</h3>
                        <p>Relax and unwind at the world's most stunning beaches.</p>
                    </div>
                </div>

                <div class="item">
                    <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1600"
                        alt="Mountain Adventure" class="img-responsive center-block" />
                    <div class="carousel-caption">
                        <h3>Adventure in the Mountains</h3>
                        <p>Experience thrilling mountain treks and breathtaking views.</p>
                    </div>
                </div>
                
                <div class="item">
                    <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?w=1600"
                        alt="City Tours" class="img-responsive center-block" />
                    <div class="carousel-caption">
                        <h3>Discover Vibrant Cities</h3>
                        <p>Explore culture, food, and nightlife in top city destinations.</p>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#tourCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#tourCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Package List Section -->
    <div class="container">
        <div class="holiday">
            <h3>Package List</h3>

            <?php 
            $sql = "SELECT * FROM tourpackages ORDER BY RAND() LIMIT 4";
            $result = mysqli_query($conn, $sql);
            $cnt = 1;
            
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_object($result)) {
            ?>
                    <div class="rom-btm">
                        <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
                            <?php
                                        $imagePath = './admin/' . $row->PackageImage;
                                        $imageSrc = (!empty($row->PackageImage) && file_exists($imagePath)) 
                                            ? $imagePath 
                                            : './images/default-package.jpg';
                                    ?>
                            <img src="<?php echo $imageSrc; ?>" class="img-responsive" alt="<?php echo htmlspecialchars($row->PackageName); ?>">
                        </div>
                        <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
                            <h4>Package Name: <?php echo htmlspecialchars($row->PackageName); ?></h4>
                            <h6>Package Type: <?php echo htmlspecialchars($row->PackageType); ?></h6>
                            <p><b>Package Location:</b> <?php echo htmlspecialchars($row->PackageLocation); ?></p>
                            <p><b>Features:</b> <?php echo htmlspecialchars($row->PackageFetures); ?></p>
                            <p><?php echo nl2br(htmlspecialchars($row->PackageDetails)); ?></p>
                        </div>
                        <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
                            <h5>₹ <?php echo number_format($row->PackagePrice, 2); ?></h5>
                            <a href="package-details.php?pkgid=<?php echo $row->PackageId; ?>" class="view">Details</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
            <?php 
                    $cnt++;
                }
            } else {
                echo '<div class="no-packages">
                        <h4>No Packages Available</h4>
                        <p>Please check back later.</p>
                      </div>';
            }
            ?>
            
            <div style="text-align: left; margin: 30px 0;">
                <a href="packages_list.php" class="view">View More Packages</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

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

        // Additional responsive behavior
        $(document).ready(function() {
            function adjustNavigation() {
                if ($(window).width() < 768) {
                    // Mobile adjustments if needed
                } else {
                    // Desktop adjustments if needed
                }
            }

            adjustNavigation();
            $(window).resize(adjustNavigation);
        });
    </script>

</body>
</html>