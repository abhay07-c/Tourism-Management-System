<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('location: index.php');
    exit();
}

include('./includes/config.php');

// DELETE package
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM tourpackages WHERE PackageId = $id");
    echo "<script>alert('Package Deleted Successfully');</script>";
    echo "<script>window.location.href='manage-packages.php';</script>";
    exit();
}

// FETCH packages
$result = mysqli_query($conn, "SELECT * FROM tourpackages ORDER BY PackageId DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
  
</head>
<style>
    .btn-action {
    padding: 10px 30px;
    margin: 4px 0; /* <-- TOP-BOTTOM margin રાખો, left-right નહીં */
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: all 0.3s ease;
    color: white;
    width: 100%; /* <-- બટનને ફુલ વિડ્થ આપો (ઓપ્શનલ) */
    box-sizing: border-box;
}
</style>>
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
            <a href="dashboard.php">Home</a> > <a href="dashboard.php">Dashboard</a> > Manage Packages
        </div>

        <!-- Main Content Area -->
        <div class="content-wrapper">
            <div class="table-container">
                <h2>Manage Packages</h2>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Package Name</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Price (USD)</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo htmlspecialchars($row['PackageName']); ?></td>
                                <td><?php echo htmlspecialchars($row['PackageType']); ?></td>
                                <td><?php echo htmlspecialchars($row['PackageLocation']); ?></td>
                                <td><?php echo htmlspecialchars($row['PackagePrice']); ?></td>
                                <td>
                                    <?php if ($row['PackageImage']) { ?>
                                        <img src="<?php echo $row['PackageImage']; ?>" width="80" height="50" style="object-fit:cover; border-radius:4px;">
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="update-package.php?id=<?php echo $row['PackageId']; ?>" class="btn-action btn-edit"><i class="fas fa-edit"></i></a>
                                    <a href="manage-packages.php?delete=<?php echo $row['PackageId']; ?>" onclick="return confirm('Are you sure to delete this package?');" class="btn-action btn-delete"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
