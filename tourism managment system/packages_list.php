<?php
// Database connection
include('./includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tourism Management System - Packages</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" />
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />
 
    <!--cdn linl-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />
  <!-- Custom CSS -->
    <link rel="stylesheet" href="./css//style.css"/>
</head>
<body>
<?php include('./includes/header.php'); ?>
  
    <div class="banner-3">
        <div class="container">
            <h1 class="wow zoomIn animated" data-wow-delay=".5s">TMS - Package List</h1>
        </div>
    </div>
    
    <!--- /banner ---->
    <!--- rooms ---->
    <div class="rooms">
        <div class="container">
            <div class="room-bottom">
                <h3>Package List</h3>

                <?php 
                $sql = "SELECT * FROM tourpackages";
                $result = mysqli_query($conn, $sql);
                $cnt = 1;
                
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_object($result)) {
                ?>
                        <div class="rom-btm">
                            <div class="row">
                                <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
                                    <?php
                                        $imagePath = './admin/' . $row->PackageImage;
                                        $imageSrc = (!empty($row->PackageImage) && file_exists($imagePath)) 
                                            ? $imagePath 
                                            : './images/default-package.jpg';
                                    ?>
                                    <img src="<?php echo $imageSrc; ?>" 
                                         alt="<?php echo htmlspecialchars($row->PackageName); ?>" 
                                         class="img-responsive" />
                                </div>
                                <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
                                    <h4>Package Name: <?php echo htmlspecialchars($row->PackageName); ?></h4>
                                    <h6>Package Type : <?php echo htmlspecialchars($row->PackageType); ?></h6>
                                    <p><b>Package Location :</b> <?php echo htmlspecialchars($row->PackageLocation); ?></p>
                                    <p><b>Features</b> <?php echo htmlspecialchars($row->PackageFetures); ?></p>
                                    <p><?php echo nl2br(htmlspecialchars($row->PackageDetails)); ?></p>
                                </div>
                                <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
                                    <h5>₹
                                       <?php echo htmlspecialchars($row->PackagePrice); ?></h5>
                                     <a href="package-details.php?pkgid=<?php echo $row->PackageId; ?>" class="view">Details</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
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
            </div>
        </div>
    </div>
    
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