<?php
session_start();
include('./includes/config.php');

// User login check
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Get Package ID
if (!isset($_GET['pkgid']) || !is_numeric($_GET['pkgid'])) {
    die("Invalid Package ID.");
}
$pkgid = intval($_GET['pkgid']);

// Fetch package details
$sql = "SELECT * FROM tourpackages WHERE PackageId = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $pkgid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$package = mysqli_fetch_assoc($result);

if (!$package) {
    die("Package not found.");
}

// Handle form submit
if (isset($_POST['submit'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $persons = intval($_POST['persons']);
    $comment = $_POST['comment'];
    $payment = $_POST['payment'];
    $email = $_SESSION['login'];

    // Calculate total price
    $totalAmount = $persons * $package['PackagePrice'];

    $insert = "INSERT INTO tblbooking(PackageId, UserEmail, FromDate, ToDate, Comment, PersonCount, TotalAmount, status) 
               VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
    $stmt = mysqli_prepare($conn, $insert);
    mysqli_stmt_bind_param($stmt, "issssii", $pkgid, $email, $fromDate, $toDate, $comment, $persons, $totalAmount);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $bookingId = mysqli_insert_id($conn);
        header("Location: bill.php?bid=$bookingId");
        exit;
    } else {
        $msg = "<div class='alert alert-danger'>Booking Failed, Try Again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Booking</title>
    <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />

    <!-- Datepicker CSS -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

    <link rel="stylesheet" href=".//css//style.css">
</head>

<body>
    <?php include('./includes/header.php'); ?>



  <!-- Banner Section -->
    <div class="banner-3">
        <div class="container">
            <h1 class="wow zoomIn animated" data-wow-delay=".5s">Booking</h1>
        </div>
    </div>

    <div class="boke">
        <h2>Book: <?php echo htmlspecialchars($package['PackageName']); ?></h2>
        <?php if (!empty($msg)) echo $msg; ?>

        <form method="post">
            <div class="form-group">
                <label>From Date</label>
                <input type="text" name="fromDate" id="fromDate" class="form-control" required>
            </div>
            <div class="form-group">
                <label>To Date</label>
                <input type="text" name="toDate" id="toDate" class="form-control" required>
            </div>
            <div class="form-group">
                <label>No. of Persons</label>
                <input type="number" name="persons" id="persons" class="form-control" min="1" value="1" required>
            </div>
            <div class="form-group">
                <label>Total Price</label>
                <input type="text" id="totalPrice" class="form-control" value="<?php echo $package['PackagePrice']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Comment (Optional)</label>
                <textarea name="comment" class="form-control"></textarea>
            </div>

            <!-- Payment Section -->
            <div class="form-group">
                <label>Payment Method</label><br>
                <label><input type="radio" name="payment" value="cash" checked> Cash</label>
                <label><input type="radio" name="payment" value="upi"> UPI</label>
            </div>

            <!-- Show UPI QR -->
            <div id="upiBox">
                <p>Scan & Pay using UPI:</p>
                <img src="./images/qr.png" width="200" alt="UPI QR Code">
            </div>

            <button type="submit" name="submit" class="btn btn-success">Confirm Booking</button>
        </form>
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




        
    $(function () {
        // Datepicker
        $("#fromDate").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            onSelect: function (selectedDate) {
                var minEndDate = $(this).datepicker("getDate");
                if (minEndDate) {
                    minEndDate.setDate(minEndDate.getDate() + 1);
                    $("#toDate").datepicker("option", "minDate", minEndDate);
                }
            }
        });
        $("#toDate").datepicker({ dateFormat: "dd-mm-yy", minDate: 1 });

        // Total Price Calculation
        var packagePrice = <?php echo $package['PackagePrice']; ?>;
        function updateTotal() {
            var persons = parseInt($("#persons").val()) || 1;
            var total = persons * packagePrice;
            $("#totalPrice").val(total);
        }
        updateTotal();
        $("#persons").on("input", updateTotal);

        // Show/Hide UPI QR
        $("input[name='payment']").on("change", function () {
            if ($(this).val() === "upi") {
                $("#upiBox").fadeIn(300);
            } else {
                $("#upiBox").fadeOut(200);
            }
        });
    });
    </script>
</body>
</html>