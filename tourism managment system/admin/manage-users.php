<?php
session_start();
include('./includes/config.php');
if (!isset($_SESSION['login'])) {
    header('location: index.php');
    exit();
}

// Delete user
if (isset($_GET['delid'])) {
    $delid = intval($_GET['delid']);
    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
    $stmt->bind_param("i", $delid);
    $stmt->execute();
    $stmt->close();
    header('location: manage-users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - TMS</title>
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
            <a href="dashboard.php">Home</a> > Manage Users
        </div>

        <!-- Users Table -->
        <div class="content-wrapper">
            <h2 class="page-title">Manage Users</h2>
            <div class="table-container">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM user";
                        $result = $conn->query($sql);
                        $cnt = 1;
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlentities($cnt) . "</td>";
                                echo "<td>" . htmlentities($row['name']) . "</td>";
                                echo "<td>" . htmlentities($row['email']) . "</td>";
                                echo "<td>" . htmlentities($row['phone']) . "</td>";
                                echo "<td>
                                        <a href='edit-user.php?uid=" . $row['id'] . "' class='btn btn-sm btn-primary me-2'><i class='fas fa-edit'></i></a>
                                        <a href='manage-users.php?delid=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>
                                      </td>";
                                echo "</tr>";
                                $cnt++;
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No users found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
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
