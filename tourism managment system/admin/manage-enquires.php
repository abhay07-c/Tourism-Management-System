<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: index.php');
    exit();
}

include('./includes/config.php');

// DELETE enquiry
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM tblenquiry WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Enquiry Deleted Successfully');</script>";
    } else {
        echo "<script>alert('Error deleting enquiry.');</script>";
    }
    echo "<script>window.location.href='manage-enquires.php';</script>";
    exit();
}

// MARK enquiry as read
if (isset($_GET['eid'])) {
    $id = intval($_GET['eid']);
    
    // Use prepared statement to update status
    $stmt = $conn->prepare("UPDATE tblenquiry SET Status = 1 WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Enquiry Marked as Read');</script>";
    } else {
        echo "<script>alert('Error updating enquiry.');</script>";
    }
    echo "<script>window.location.href='manage-enquires.php';</script>";
    exit();
}

// FETCH enquiries
$stmt = $conn->prepare("SELECT * FROM tblenquiry ORDER BY id DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Enquiries</title>
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
            <a href="dashboard.php">Home</a> > <span>Manage Enquiries</span>
        </div>

            <!-- Main Content Wrapper -->
            <div class="content-wrapper">
                <div class="table-container">
                    <h2>Manage Enquiries</h2>

                    <?php if ($result->num_rows > 0): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_object()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row->id); ?></td>
                                        <td><?php echo htmlspecialchars($row->FullName); ?></td>
                                        <td><?php echo htmlspecialchars($row->EmailId); ?></td>
                                        <td><?php echo htmlspecialchars($row->MobileNumber); ?></td>
                                        <td><?php echo htmlspecialchars($row->Subject); ?></td>
                                        <td style="max-width: 200px; word-wrap: break-word;">
                                            <?php echo htmlspecialchars(substr($row->Description, 0, 100)); ?>
                                            <?php if (strlen($row->Description) > 100): ?>
                                                <a href="#" onclick="alert('Full Description:\n\n<?php echo addslashes($row->Description); ?>'); return false;">[...more]</a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo date('d M Y h:i A', strtotime($row->PostingDate)); ?></td>
                                        <td>
                                            <?php if ($row->Status == 1): ?>
                                                <span class="badge bg-success">Read</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">Unread</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row->Status == 1): ?>
                                                <!-- Enquiry is already read -->
                                                Read | 
                                                <a href="manage-enquires.php?action=delete&id=<?php echo urlencode($row->id);?>" 
                                                onclick="return confirm('Do you really want to delete this enquiry?')" 
                                                style="color:red; text-decoration: none;">Delete</a>
                                            <?php else: ?>
                                                <!-- Enquiry is pending -->
                                                <a href="manage-enquires.php?eid=<?php echo urlencode($row->id);?>" 
                                                onclick="return confirm('Mark this enquiry as read?')" 
                                                style="text-decoration: none;">Pending</a> | 
                                                <a href="manage-enquires.php?action=delete&id=<?php echo urlencode($row->id);?>" 
                                                onclick="return confirm('Do you really want to delete this enquiry?')" 
                                                style="color:red; text-decoration: none;">Delete</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-envelope-open-text fa-4x text-muted mb-3"></i>
                            <h5>No enquiries found.</h5>
                            <p class="text-secondary">All user inquiries will appear here.</p>
                        </div>
                    <?php endif; ?>
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