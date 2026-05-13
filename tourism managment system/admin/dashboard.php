<?php
 session_start();
 include('./includes/config.php');
if (!isset($_SESSION['login'])) {
    header('location: index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System</title>
    <!-- Replace your current head links with this -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="./css/style.css">
   
</head>
<style>
    .fas  {
         font-size: 2rem;
    }
</style>

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
            <a href="#">Home</a> > Dashboard
        </div>

        <!-- Replace your existing Four Grids section with this -->
<div class="dashboard-container">
    <h2 class="dashboard-title">Dashboard Overview</h2>
    <div class="dashboard-cards">
        <a href="manage-users.php" target="_blank" class="card card-users">
            <div class="card-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-title">Users</div>
            <div class="card-value">
                <?php
                $sql = "SELECT id FROM user";
                $result = $conn->query($sql);
                $cnt = $result ? $result->num_rows : 0;
                echo htmlentities($cnt);
                ?>
            </div>
        </a>

        <a href="manageissues.php" target="_blank" class="card card-issues">
            <div class="card-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="card-title">Issues Raised</div>
            <div class="card-value">
                <?php
                $sql5 = "SELECT id FROM tblissues";
                $result5 = $conn->query($sql5);
                $cnt5 = $result5 ? $result5->num_rows : 0;
                echo htmlentities($cnt5);
                ?>
            </div>
        </a>

        <a href="manage-packages.php" target="_blank" class="card card-packages">
            <div class="card-icon">
                <i class="fas fa-suitcase"></i>
            </div>
            <div class="card-title">Total Packages</div>
            <div class="card-value">
                <?php
                $sql3 = "SELECT PackageId FROM tourpackages";
                $result3 = $conn->query($sql3);
                $cnt3 = $result3 ? $result3->num_rows : 0;
                echo htmlentities($cnt3);
                ?>
            </div>
        </a>

        <a href="manage-enquires.php" target="_blank" class="card card-enquiries">
            <div class="card-icon">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <div class="card-title">Enquiries</div>
            <div class="card-value">
                <?php
                $sql2 = "SELECT id FROM tblenquiry";
                $result2 = $conn->query($sql2);
                $cnt2 = $result2 ? $result2->num_rows : 0;
                echo htmlentities($cnt2);
                ?>
            </div>
        </a>

        <a href="manage-bookings.php" target="_blank" class="card card-bookings">
            <div class="card-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="card-title">Bookings</div>
            <div class="card-value">
                <?php
                $sql1 = "SELECT BookingId FROM tblbooking";
                $result1 = $conn->query($sql1);
                $cnt1 = $result1 ? $result1->num_rows : 0;
                echo htmlentities($cnt1);
                ?>
            </div>
        </a>

        <a href="manage-bookings.php" target="_blank" class="card card-new-bookings">
            <div class="card-icon">
                <i class="fas fa-calendar-plus"></i>
            </div>
            <div class="card-title">New Bookings</div>
            <div class="card-value">
                <?php
                $sql = "SELECT BookingId FROM tblbooking WHERE status IS NULL OR status = ''";
                $result = $conn->query($sql);
                $newbookings = $result ? $result->num_rows : 0;
                echo htmlentities($newbookings);
                ?>
            </div>
        </a>
    </div>
</div>
    <!-- Footer -->
<div class="footer">
    <p>TMS. All Rights Reserved | <a href="#">TMS</a></p>
</div>
    </div>


  <script src="./js/main.js"></script>
</body>

</html>