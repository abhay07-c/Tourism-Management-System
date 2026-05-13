<?php
session_start();
include('./includes/config.php');

if(strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    exit();
}

$useremail = $_SESSION['login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System - Profile</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap for responsive components -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css//style.css">
</head>
<body>

<?php include('./includes/header.php'); ?>

<div class="banner-3">
    <div class="container">
        <h1 class="wow zoomIn animated" data-wow-delay=".5s">Your Tour Booking History</h1>
    </div>
</div>

<div class="main">
    <h1 class="cet">Your Tour Booking History</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Booking ID</th>
                <th>Package Name</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Status</th>             
                <th>Booking Date</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Using prepared statement for security
            $sql = "SELECT tblbooking.BookingId, tblbooking.PackageId, tblbooking.FromDate, tblbooking.ToDate, 
                           tblbooking.status, tblbooking.RegDate, tourpackages.PackageName 
                    FROM tblbooking 
                    JOIN tourpackages ON tourpackages.PackageId = tblbooking.PackageId 
                    WHERE tblbooking.UserEmail = ? 
                    ORDER BY tblbooking.RegDate DESC";
            
            if($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $useremail);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                $cnt = 1;
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td>#<?php echo htmlspecialchars($row['BookingId']); ?></td>
                            <td><?php echo htmlspecialchars($row['PackageName']); ?></td>
                            <td><?php echo date('d M Y', strtotime($row['FromDate'])); ?></td>
                            <td><?php echo date('d M Y', strtotime($row['ToDate'])); ?></td>
                            <td>
                                <?php 
                                switch($row['status']) {
                                    case 0: 
                                        echo '<span class="status-pending">Pending</span>'; 
                                        break;
                                    case 1: 
                                        echo '<span class="status-confirmed">Confirmed</span>'; 
                                        break;
                                    case 2: 
                                        echo '<span class="status-cancelled">Cancelled</span>'; 
                                        break;
                                    default: 
                                        echo '<span class="status-pending">Unknown</span>';
                                }
                                ?>
                            </td>
                            <td><?php echo date('d M Y h:i A', strtotime($row['RegDate'])); ?></td>
                        </tr>
                        <?php
                        $cnt++;
                    }
                } else {
                    echo '<tr>
                            <td colspan="7" class="no-bookings">
                                <i class="fas fa-inbox"></i>
                                No booking history found
                            </td>
                          </tr>';
                }
                mysqli_stmt_close($stmt);
            } else {
                echo '<tr>
                        <td colspan="7" class="no-bookings">
                            <i class="fas fa-exclamation-triangle"></i>
                            Error loading booking history
                        </td>
                      </tr>';
            }
            ?>
        </tbody>
    </table>

    <div class="text-center">
        <a href="index.php" class="back-home">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
    </div>
</div>

<?php include('./includes/footer.php'); ?>

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
    window.scrollTo(0, 0);
</script>
</body>
</html>