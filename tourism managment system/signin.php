<?php
session_start();
// database connection
include('./includes/config.php');

$msg = "";

// When form submitted
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simple query (plaintext password check - only for demo)
    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['login'] = $email;
        $msg = "✅ Login Successful!";
        // Redirect after login
        header("refresh:2; url=packages_list.php");
    } else {
        $msg = "❌ Invalid Email or Password!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap for responsive components -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css//style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>



<div class="main">
        <h1 class="cet">Login Form</h1>
        <div class="main-agileinfo">
            <div class="agileits-top">
                <form action="" method="post">
                    <input class="text" type="text" name="email" placeholder="Enter Email" required="">
                    <input class="text w3lpass" type="text" name="password" placeholder="Password" required="">
                    <input type="submit" name="submit" value="LOGIN">
                </form>
                <p style="color:red; text-align:center;"><?php echo $msg; ?></p>
                <p><a href="forgot_password.php">Forgot password</a></p>
            </div>
        </div>
        <ul class="colorlib-bubbles">
            <li></li><li></li><li></li><li></li><li></li>
            <li></li><li></li><li></li><li></li><li></li>
        </ul>
    </div>





        

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="./js//main.js"></script>

</body>
</html>