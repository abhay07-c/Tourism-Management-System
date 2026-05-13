<?php
session_start();
// Database connection
include('./includes/config.php');

// Check if package ID is provided
if (!isset($_GET['pkgid']) || !is_numeric($_GET['pkgid'])) {
    die("Invalid package ID.");
}
$pkgid = intval($_GET['pkgid']);

// Fetch package details
$sql = "SELECT * FROM tourpackages WHERE PackageId = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $pkgid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    die("<div class='container'><h3>Package not found.</h3><a href='packages.php' class='btn-back'>Back to Packages</a></div>");
}
$package = mysqli_fetch_object($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($package->PackageName); ?> - Package Details</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />

    <!-- Font Awesome 7 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css//style.css" />
</head>
<body>
    <?php include('./includes/header.php'); ?>

    <!-- Banner Section -->
    <div class="banner-3">
        <div class="container">
            <h1 class="wow zoomIn animated" data-wow-delay=".5s">Package Details</h1>
        </div>
    </div>

    <!-- Package Details Section -->
    <div class="selectroom">
        <div class="container">

            <!-- Top Section: Image + Details + Price -->
            <div class="selectroom_top">
                <div class="row">
                    <!-- Left: Image -->
                    <div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
                        <?php
                            $imagePath = './admin/' . $package->PackageImage;
                            $imageSrc = (!empty($package->PackageImage) && file_exists($imagePath)) 
                                ? $imagePath 
                                : './images/default-package.jpg';
                        ?>
                        <img src="<?php echo $imageSrc; ?>" 
                             alt="<?php echo htmlspecialchars($package->PackageName); ?>" 
                             class="img-responsive">
                    </div>

                    <!-- Right: Details -->
                    <div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
                        <h2><?php echo htmlspecialchars($package->PackageName); ?></h2>
                        <p class="dow">#PKG-<?php echo $package->PackageId; ?></p>
                        <p><b>Package Type:</b> <?php echo htmlspecialchars($package->PackageType); ?></p>
                        <p><b>Location:</b> <?php echo htmlspecialchars($package->PackageLocation); ?></p>
                        <p><b>Features:</b> <?php echo htmlspecialchars($package->PackageFetures); ?></p>

                        <!-- Price -->
                        <div class="grand">
                            <p>Grand Total</p>
                            <h3>₹
                                 <?php echo number_format($package->PackagePrice, 2); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <!-- Package Details -->
            <div class="selectroom_top">
                <h3>Package Details</h3>
                <p style="padding-top: 1%"><?php echo nl2br(htmlspecialchars($package->PackageDetails)); ?></p>
            </div>

            <!-- Booking Button -->
            <div class="selectroom_top text-center" style="margin-top: 30px; margin-bottom: 30px;">
                <?php if (isset($_SESSION['login']) && $_SESSION['login'] == true): ?>
                    <!-- If logged in, go to booking -->
                    <a href="booking.php?pkgid=<?php echo $pkgid; ?>" class="btn btn-primary btn-lg">
                        <i class="fa fa-calendar-check-o"></i> Book This Package
                    </a>
                <?php else: ?>
                    <!-- If not logged in, set redirect and go to signin -->
                    <?php $_SESSION['redirect_url'] = "booking.php?pkgid=" . $pkgid; ?>
                    <a href="signin.php" class="btn btn-primary btn-lg">
                        <i class="fa fa-sign-in"></i> Sign in to Book
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php include('./includes/footer.php'); ?>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Datepicker Script -->
    <script>
        new WOW().init();
    </script>
</body>
</html>
