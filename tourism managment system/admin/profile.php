<?php
session_start();
include('./includes/config.php'); // $conn = mysqli connection

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$adminid = $_SESSION['login'];
$msg = "";

// Update profile when form is submitted
if (isset($_POST['submit'])) {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $mobile = $_POST['mobile'];

    $sql = "UPDATE admin SET name=?, email=?, mobile=? WHERE UserName=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $name, $email, $mobile, $adminid);

    if ($stmt->execute()) {
        $msg = "<div class='alert alert-success'>Profile updated successfully.</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Error updating profile: " . $conn->error . "</div>";
    }
}

// Fetch current profile details
$sql = "SELECT * FROM admin WHERE UserName = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $adminid);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css//style.css">
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
            <a href="dashboard.php">Home</a> > <span>Admin Profile</span>
        </div>

<div class="main-content p-4">
    <?php if ($msg): ?>
    <div class="alert <?php echo strpos($msg, 'successfully') !== false ? 'alert-success' : 'alert-danger'; ?>">
        <?php echo htmlentities($msg); ?>
    </div>
<?php endif; ?>

    <form method="post" class="form-horizontal">
          <h2>Admin Profile</h2>
        <?php 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <div class="mb-3">
                    <label class="form-label">User Name</label>
                    <input type="text" class="form-control" name="username" 
                           value="<?php echo htmlentities($row['UserName']); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" 
                           value="<?php echo htmlentities($row['name']); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" 
                           value="<?php echo htmlentities($row['email']); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mobile No</label>
                    <input type="text" class="form-control" name="mobile" 
                           value="<?php echo htmlentities($row['mobile']); ?>">
                </div>
        <?php }} ?>
        
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
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
