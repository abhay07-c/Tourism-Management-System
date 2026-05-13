<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location: index.php");
    exit();
}

include("includes/config.php");

// check package id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("location: manage-packages.php");
    exit();
}
$id = intval($_GET['id']);

// update package
if (isset($_POST['update'])) {
    $packagename     = $_POST['packagename'];
    $packagetype     = $_POST['packagetype'];
    $packagelocation = $_POST['packagelocation'];
    $packageprice    = $_POST['packageprice'];
    $packagefeatures = $_POST['packagefeatures'];
    $packagedetails  = $_POST['packagedetails'];

    // image upload check
    if (!empty($_FILES['packageimage']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir);
        }
        $imagename = time() . "_" . $_FILES['packageimage']['name'];
        $target_file = $target_dir . $imagename;
        move_uploaded_file($_FILES['packageimage']['tmp_name'], $target_file);

        $sql = "UPDATE tourpackages SET 
                    PackageName='$packagename',
                    PackageType='$packagetype',
                    PackageLocation='$packagelocation',
                    PackagePrice='$packageprice',
                    PackageFetures='$packagefeatures',
                    PackageDetails='$packagedetails',
                    PackageImage='$target_file'
                WHERE PackageId=$id";
    } else {
        $sql = "UPDATE tourpackages SET 
                    PackageName='$packagename',
                    PackageType='$packagetype',
                    PackageLocation='$packagelocation',
                    PackagePrice='$packageprice',
                    PackageFetures='$packagefeatures',
                    PackageDetails='$packagedetails'
                WHERE PackageId=$id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Package Updated Successfully');</script>";
        echo "<script>window.location='manage-packages.php';</script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// fetch existing data
$result = mysqli_query($conn, "SELECT * FROM tourpackages WHERE PackageId=$id");
$package = mysqli_fetch_assoc($result);
if (!$package) {
    echo "Package not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Package</title>
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
                <li>
                    <a href="#"><i class="fas fa-list-ul"></i> <span>Tour Packages</span> <i class="fas fa-chevron-right" style="margin-left:auto;"></i></a>
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
            <a href="dashboard.php">Home</a> > <a href="manage-packages.php"></a>Update Package
        </div>
        
      
       
    <form method="post" enctype="multipart/form-data">
           <h2>Update Package</h2>
        <p>
            Package Name: <br>
            <input type="text" name="packagename" value="<?php echo $package['PackageName']; ?>" required>
        </p>
        <p>
            Package Type: <br>
            <input type="text" name="packagetype" value="<?php echo $package['PackageType']; ?>" required>
        </p>
        <p>
            Location: <br>
            <input type="text" name="packagelocation" value="<?php echo $package['PackageLocation']; ?>" required>
        </p>
        <p>
            Price: <br>
            <input type="number" name="packageprice" value="<?php echo $package['PackagePrice']; ?>" required>
        </p>
        <p>
            Features: <br>
            <textarea name="packagefeatures" rows="3"><?php echo $package['PackageFetures']; ?></textarea>
        </p>
        <p>
            Details: <br>
            <textarea name="packagedetails" rows="4"><?php echo $package['PackageDetails']; ?></textarea>
        </p>
        <p>
            Current Image: <br>
            <?php if ($package['PackageImage']) { ?>
                <img src="<?php echo $package['PackageImage']; ?>" width="120"><br>
            <?php } ?>
            Upload New Image: <br>
            <input type="file" name="packageimage">
        </p>
        <p>
            <button type="submit" name="update">Update Package</button>
            <a href="manage-packages.php">Back</a>
        </p>
    </form>

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
