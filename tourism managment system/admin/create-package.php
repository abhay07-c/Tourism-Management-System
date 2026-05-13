<?php
session_start(); 

if (!isset($_SESSION['login'])) {
    header('location: index.php');
    exit();
}

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    unset($_SESSION['login']);
    session_destroy();
    header('location: index.php');
    exit();
}

include('./includes/config.php');

if (isset($_POST['submit'])) {
    $packagename = $_POST['packagename'];
    $packagetype = $_POST['packagetype'];
    $packagelocation = $_POST['packagelocation'];
    $packageprice = $_POST['packageprice'];
    $packagefeatures = $_POST['packagefeatures'];
    $packagedetails = $_POST['packagedetails'];
    $packageimage = "packagimage/".$_FILES["packageimage"]["name"];
    move_uploaded_file($_FILES['packageimage']['tmp_name'],$packageimage);
    
    mysqli_query($conn,"INSERT INTO tourpackages(PackageName,PackageType,PackageLocation,PackagePrice,PackageFetures,PackageDetails,PackageImage) VALUES('$packagename','$packagetype','$packagelocation','$packageprice','$packagefeatures','$packagedetails','$packageimage')");
    echo "<script>alert('Package Created Successfully');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Package</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
   
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <button class="toggle-btn" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>

                <!-- Tour Packages with Dropdown -->
                <li>
                    <a href="#"><i class="fas fa-list-ul"></i> <span>Tour Packages</span> <i class="fas fa-chevron-right" style="margin-left: auto;"></i></a>
                    <ul class="submenu">
                        <li><a href="create-package.php"><i class="fas fa-plus"></i> <span>Create</span></a></li>
                        <li><a href="manage-packages.php"><i class="fas fa-edit"></i> <span>Manage</span></a></li>
                    </ul>
                </li>

                <li><a href="manage-users.php"><i class="fas fa-users"></i> <span>Manage Users</span></a></li>
                <li><a href="manage-bookings.php"><i class="fas fa-calendar-check"></i> <span>Manage Booking</span></a></li>
                <li><a href="manageissues.php"><i class="fas fa-exclamation-triangle"></i> <span>Manage Issues</span></a></li>
                <li><a href="manage-enquires.php"><i class="fas fa-envelope"></i> <span>Manage Enquiries</span></a></li>
                <li><a href="manage-pages.php"><i class="fas fa-file"></i> <span>Manage Pages</span></a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="logo">TOURISM MANAGEMENT SYSTEM</div>
            <div class="user-profile" id="userProfile">
                <i class="fas fa-user-circle"></i>
                <span>Welcome</span>
                <span>Administrator</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div id="dropdownMenu" class="dropdown-menu">
                <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="change-password.php"><i class="fas fa-cog"></i> Settings</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="dashboard.php">Home</a> > <a href="dashboard.php">Dashboard</a> > Create Package
        </div>

        <!-- Main Content Area -->
        <div class="content-wrapper">
            <div class="form-container animated fadeInUp">
                <h2>Create Package</h2>
                
                <form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="packagename">Package Name</label>
                        <input type="text" name="packagename" id="packagename" placeholder="Create Package" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="packagetype">Package Type</label>
                        <input type="text" name="packagetype" id="packagetype" placeholder="Package Type eg: Family Package / Couple Package" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="packagelocation">Package Location</label>
                        <input type="text" name="packagelocation" id="packagelocation" placeholder="Package Location" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="packageprice">Package Price in USD</label>
                        <input type="number" name="packageprice" id="packageprice" placeholder="Package Price is USD" min="0" step="0.01" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="packagefeatures">Package Features</label>
                        <input type="text" name="packagefeatures" id="packagefeatures" placeholder="Package Features E.g. free Pickup-drop facility" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="packagedetails">Package Details</label>
                        <textarea name="packagedetails" id="packagedetails" rows="5" placeholder="Package Details" required class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="packageimage">Package Image</label>
                        <input type="file" name="packageimage" id="packageimage" accept="image/*" required class="form-control">
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="btn btn-primary">CREATE</button>
                        <button type="reset" class="btn btn-secondary">RESET</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>TMS. All Rights Reserved | <a href="#">TMS</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>