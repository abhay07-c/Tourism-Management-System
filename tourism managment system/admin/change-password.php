<?php
session_start();
include('./includes/config.php'); // DB connection

// Check if admin is logged in
if (!isset($_SESSION['login'])) {
    header('location:index.php');
    exit;
}

$msg = "";

if (isset($_POST['submit'])) {
    $currentPassword = trim($_POST['currentPassword']);
    $newPassword = trim($_POST['newPassword']);
    $confirmPassword = trim($_POST['confirmPassword']);

    if ($currentPassword == "" || $newPassword == "" || $confirmPassword == "") {
        $msg = '<div class="alert alert-danger">All fields are required!</div>';
    } elseif ($newPassword !== $confirmPassword) {
        $msg = '<div class="alert alert-danger">New Password and Confirm Password do not match!</div>';
    } else {
        $adminId = $_SESSION['admin_id'];

        // Fetch current password from DB
        $stmt = $conn->prepare("SELECT Password FROM admin WHERE id = ?");
        $stmt->bind_param("i", $adminId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row && $row['Password'] === $currentPassword) {
            // Update password
            $stmt = $conn->prepare("UPDATE admin SET Password = ?, updationDate = NOW() WHERE id = ?");
            $stmt->bind_param("si", $newPassword, $adminId);
            if ($stmt->execute()) {
                $msg = '<div class="alert alert-success">Password updated successfully!</div>';
            } else {
                $msg = '<div class="alert alert-danger">Error updating password.</div>';
            }
        } else {
            $msg = '<div class="alert alert-danger">Current password is incorrect!</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cHANAGE PASSWORD</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<style>
    
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
                <li><a href="manage-enquires.php" class="active"><i class="fas fa-envelope"></i> <span>Manage Enquiries</span></a></li>
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
            <a href="dashboard.php">Home</a><span>Chanage Password</span>
<div class="main-content">
    <?php echo $msg; ?>
    <form method="post" class="mt-4" style="max-width: 500px;">
        <h2>Change Password</h2>
        <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" name="currentPassword" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" name="newPassword" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="password" name="confirmPassword" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Change Password</button>
    </form>
</div>

     <!-- Footer -->
        <div class="footer">
            <p>TMS. All Rights Reserved | <a href="#">TMS</a></p>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>
