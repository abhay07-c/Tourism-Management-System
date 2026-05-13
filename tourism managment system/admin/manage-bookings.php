<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

// Include database connection
include('./includes/config.php');

// DELETE booking
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Secure ID

    $sql = "DELETE FROM tblbooking WHERE BookingId = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Booking deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting booking!');</script>";
    }
    echo "<script>window.location.href='manage-bookings.php';</script>";
    exit();
}

// CANCEL booking
if (isset($_GET['action']) && $_GET['action'] == 'cancel' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "UPDATE tblbooking SET status = 2, CancelledBy = 'admin' WHERE BookingId = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Booking cancelled successfully!');</script>";
    } else {
        echo "<script>alert('Error cancelling booking!');</script>";
    }
    echo "<script>window.location.href='manage-bookings.php';</script>";
    exit();
}

// CONFIRM booking (set status to 1)
if (isset($_GET['action']) && $_GET['action'] == 'confirm' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "UPDATE tblbooking SET status = 1 WHERE BookingId = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Booking confirmed successfully!');</script>";
    } else {
        echo "<script>alert('Error confirming booking!');</script>";
    }
    echo "<script>window.location.href='manage-bookings.php';</script>";
    exit();
}

// Fetch all bookings from database
$sql = "SELECT * FROM tblbooking ORDER BY BookingId DESC";
$result = mysqli_query($conn, $sql);
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
            <a href="dashboard.php">Home</a> > <span>Manage Booking</span>
        </div>

        <!-- Page Title & Table -->
        <div class="container mt-4">
            <h3><i class="fas fa-calendar-check"></i> Manage Bookings</h3>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Package ID</th>
                        <th>User Email</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Status</th>
                        <th>Comment</th>
                        <th>Booked On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $status = $row['status'];
                            $statusText = "Unknown";
                            $badgeClass = "bg-secondary";

                            if ($status == 0) {
                                $statusText = "Pending";
                                $badgeClass = "bg-warning";
                            } elseif ($status == 1) {
                                $statusText = "Confirmed";
                                $badgeClass = "bg-success";
                            } elseif ($status == 2) {
                                $statusText = "Cancelled";
                                $badgeClass = "bg-danger";
                            }

                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['BookingId']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['PackageId']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['UserEmail']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['FromDate']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['ToDate']) . "</td>";
                            echo "<td><span class='badge " . $badgeClass . "'>" . htmlspecialchars($statusText) . "</span></td>";
                            echo "<td>" . (htmlspecialchars($row['Comment']) ? htmlspecialchars($row['Comment']) : "-") . "</td>";
                            echo "<td>" . date('d M Y h:i A', strtotime($row['RegDate'])) . "</td>";
                            echo "<td>";

                            // Show actions based on status
                            if ($status == 0) { // Pending
                                echo "<a href='?action=confirm&id=" . $row['BookingId'] . "' 
                                      onclick='return confirm(\"Are you sure you want to CONFIRM this booking?\")' 
                                      class='btn btn-sm btn-success'>Confirm</a> ";
                                echo "<a href='?action=cancel&id=" . $row['BookingId'] . "' 
                                      onclick='return confirm(\"Are you sure you want to CANCEL this booking?\")' 
                                      class='btn btn-sm btn-danger'>Cancel</a> ";
                            } elseif ($status == 1) { // Confirmed
                                echo "<span class='badge bg-primary'>Confirmed</span>";
                            } elseif ($status == 2) { // Cancelled
                                echo "<span class='badge bg-danger'>Cancelled</span>";
                            }

                            // Always show Delete (even if cancelled)
                            echo "<a href='?action=delete&id=" . $row['BookingId'] . "' 
                                  onclick='return confirm(\"Are you sure you want to PERMANENTLY DELETE this booking? This cannot be undone!\")' 
                                  class='btn btn-sm btn-outline-danger'>Delete</a>";

                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center text-muted'>No bookings found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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