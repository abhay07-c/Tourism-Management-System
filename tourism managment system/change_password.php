<?php
// change_password.php
session_start();
include('./includes/config.php');

// Check if user is logged in
if(strlen($_SESSION['login']) == 0) {
    header('location: signin.php');
}

if(isset($_POST['submit']))
{
    $email = $_SESSION['login'];
    $currentpassword = md5($_POST['currentpassword']);
    $newpassword = md5($_POST['newpassword']);
    
    // Check current password
    $sql = "SELECT email FROM user WHERE email='$email' and password='$currentpassword'";
    $query = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($query);
    
    if($rows > 0)
    {
        // Update with new password
        $con = "UPDATE user SET password='$newpassword' WHERE email='$email'";
        $chngpwd1 = mysqli_query($conn, $con);
        $msg = "Your Password successfully changed";
    }
    else {
        $error = "Current Password is wrong";  
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System - Change Password</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap for responsive components -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript">
function valid()
{
    if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value)
    {
        alert("New Password and Confirm Password Field do not match!!");
        document.chngpwd.confirmpassword.focus();
        return false;
    }
    return true;
}
</script>
</head>
<body>

<div class="main">
    <h1 class="cet">Change Password</h1>
    <div class="main-agileinfo">
        <div class="agileits-top">
            <h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown; margin-top: 0; margin-bottom: 25px;">Change Password</h3>
            
            <?php if(isset($error)){?><div class="errorWrap" style="color: red; padding: 10px; background: #f8d7da; border-radius: 5px; margin-bottom: 20px;"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div><?php } 
                else if(isset($msg)){?><div class="succWrap" style="color: green; padding: 10px; background: #d4edda; border-radius: 5px; margin-bottom: 20px;"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div><?php }?>
            
            <form name="chngpwd" method="post" onSubmit="return valid();">
                <p>
                    <input type="password" name="currentpassword" class="form-control" id="currentpassword" placeholder="Current Password" required="">
                </p> 

                <p>
                    <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="New Password" required="">
                </p>

                <p>
                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Confirm New Password" required="">
                </p>

                <p>
                    <input type="submit" name="submit" value="Change Password" class="btn-primary btn">
                </p>
            </form>
            <p><a href="index.php">Back to Home</a></p>
        </div>
    </div>
    
    <!-- Bubbles Animation -->
    <ul class="colorlib-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>

</body>
</html>