<?php
session_start();
include('./includes/config.php');

// User login check
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Check Booking ID
if (!isset($_GET['bid']) || !is_numeric($_GET['bid'])) {
    die("Invalid Booking ID.");
}
$bid = intval($_GET['bid']);

// Fetch Booking Details with Package Info
$sql = "SELECT b.*, p.PackageName, p.PackagePrice, u.name, u.email, u.phone 
        FROM tblbooking b
        JOIN tourpackages p ON b.PackageId = p.PackageId
        JOIN user u ON u.email = b.UserEmail
        WHERE b.BookingId = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $bid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    die("Booking not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Bill Invoice</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />

    <!-- Font Awesome 7 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href=".//css.//style.css" />
</head>
<style>
    
</style>
<body>
    <?php include('./includes/header.php'); ?>

    <!-- Banner Section -->
    <div class="banner-3">
        <div class="container">
            <h1 class="wow zoomIn animated" data-wow-delay=".5s"> Invoice Details</h1>
        </div>
    </div>


    <div class="invoice-box">
        <h2 class="text-center">Booking Invoice</h2>

        <p><strong>Booking ID:</strong> #<?php echo $booking['BookingId']; ?></p>
        <p><strong>Date:</strong> <?php echo date("d-m-Y", strtotime($booking['RegDate'])); ?></p>

        <hr>

        <h4>Customer Details</h4>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($booking['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($booking['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($booking['phone']); ?></p>

        <hr>

        <h4>Booking Details</h4>
        <table class="table table-bordered">
            <tr>
                <th>Package Name</th>
                <td><?php echo htmlspecialchars($booking['PackageName']); ?></td>
            </tr>
            <tr>
                <th>From Date</th>
                <td><?php echo $booking['FromDate']; ?></td>
            </tr>
            <tr>
                <th>To Date</th>
                <td><?php echo $booking['ToDate']; ?></td>
            </tr>
            <tr>
                <th>No. of Persons</th>
                <td><?php echo $booking['PersonCount']; ?></td>
            </tr>
            <tr>
                <th>Price per Person</th>
                <td>₹<?php echo number_format($booking['PackagePrice'], 2); ?></td>
            </tr>
            <tr>
                <th>Total Amount</th>
                <td><strong>₹<?php echo number_format($booking['TotalAmount'], 2); ?></strong></td>
            </tr>
            <tr>
                <th>Comment</th>
                <td><?php echo $booking['Comment'] ? htmlspecialchars($booking['Comment']) : "N/A"; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <?php
                    if ($booking['status'] == 0) echo "Pending";
                    elseif ($booking['status'] == 1) echo "Confirmed";
                    elseif ($booking['status'] == 2) echo "Cancelled";
                    ?>
                </td>
            </tr>
        </table>

        <button onclick="window.print()" class="btn btn-primary btn-print"><i class="glyphicon glyphicon-print"></i> Print Invoice</button>
    </div>


    <!-- Footer -->
    <?php include('./includes/footer.php'); ?>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Datepicker Script -->
    <script>
        new WOW().init();
    </script>
</body>

</html>