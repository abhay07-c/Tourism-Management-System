<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

// Include database connection
include('./includes/config.php');

// Handle admin remark submission
if (isset($_POST['update_remark'])) {
    $issue_id = intval($_POST['issue_id']);
    $admin_remark = mysqli_real_escape_string($conn, $_POST['admin_remark']);
    
    $query = mysqli_query($conn, "UPDATE tblissues SET AdminRemark='$admin_remark', AdminremarkDate=NOW() WHERE id='$issue_id'");
    
    if ($query) {
        $success_msg = "Remark updated successfully!";
    } else {
        $error_msg = "Failed to update remark. Please try again.";
    }
}

// Fetch all issues
$issues_query = mysqli_query($conn, "SELECT * FROM tblissues ORDER BY PostingDate DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Issues</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Custom CSS -->
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
            <a href="dashboard.php">Home</a> > <span>Manage Issues</span>
        </div>

        <!-- Content -->
        <div class="content">
            <h2><i class="fas fa-exclamation-triangle"></i> Manage Issues</h2>
            
            <!-- Display Messages -->
            <?php if (isset($success_msg)): ?>
                <div class="alert alert-success"><?php echo $success_msg; ?></div>
            <?php endif; ?>
            
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>
            <?php endif; ?>
            
            <div class="table-responsive">
                <?php if (mysqli_num_rows($issues_query) > 0): ?>
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Ticket ID</th>
                                <th>User Email</th>
                                <th>Issue</th>
                                <th>Description</th>
                                <th>Posting Date</th>
                                <th>Admin Remark</th>
                                <th>Remark Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($issues_query)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['UserEmail']); ?></td>
                                    <td><?php echo htmlspecialchars($row['Issue']); ?></td>
                                    <td style="max-width: 200px;">
                                        <?php echo nl2br(htmlspecialchars($row['Description'])); ?>
                                    </td>
                                    <td><?php echo date('d M Y H:i', strtotime($row['PostingDate'])); ?></td>
                                    <td>
                                        <?php if (!empty($row['AdminRemark'])): ?>
                                            <div class="admin-remark">
                                                <?php echo nl2br(htmlspecialchars($row['AdminRemark'])); ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted">No remark yet</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        if (!empty($row['AdminremarkDate'])) {
                                            echo date('d M Y H:i', strtotime($row['AdminremarkDate']));
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <!-- Remark Form -->
                                        <div class="remark-form">
                                            <form method="post">
                                                <input type="hidden" name="issue_id" value="<?php echo $row['id']; ?>">
                                                <div class="mb-2">
                                                    <textarea class="form-control" name="admin_remark" rows="2" placeholder="Enter remark..."><?php echo isset($row['AdminRemark']) ? htmlspecialchars($row['AdminRemark']) : ''; ?></textarea>
                                                </div>
                                                <button type="submit" name="update_remark" class="btn btn-primary btn-sm">Update</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No issues found.
                    </div>
                <?php endif; ?>
            </div>
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