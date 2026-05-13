<?php
session_start();
include('./includes/config.php');

// If the user is not logged in, go to the login page.
if (!isset($_SESSION['login'])) {
    header('location: signin.php');
    exit();
}

//user email and id session store
$email = $_SESSION['login'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
$user = mysqli_fetch_array($query);

if (!$user) {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System - Profile</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap for responsive components -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php  include('./includes/header.php')    ?>

<div class="profile-container">
    <div class="container">
        <div class="profile-card wow fadeInUp">
            <div class="profile-header">
                <div class="profile-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h2>User Profile</h2>
            </div>
            
            <div class="profile-content">
                <div class="profile-info">
                    <p><strong><i class="fas fa-user"></i> Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                    <p><strong><i class="fas fa-envelope"></i> Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong><i class="fas fa-phone"></i> Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
                </div>
                
                <div class="profile-actions">
                    <a href="edit-profile.php" class="btn-profile btn-edit">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                    <a href="change-password.php" class="btn-profile">
                        <i class="fas fa-key"></i> Change Password
                    </a>
                    <a href="logout.php" class="btn-profile btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
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