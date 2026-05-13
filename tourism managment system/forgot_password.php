<?php
// forgot_password.php
session_start();

include('./includes/config.php');

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);
    
    $sql = "SELECT email FROM user WHERE email='$email' and phone='$mobile'";
    $query = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($query);
    
    if($rows > 0)
    {
        $con = "UPDATE user SET password='$newpassword' WHERE email='$email' and phone='$mobile'";
        $chngpwd1 = mysqli_query($conn, $con);
        $msg = "Your Password successfully changed";
    }
    else {
        $error = "Email id or Mobile no is invalid";  
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System - Recover Password</title>
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
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
</head>
<body>

<div class="main">
    <h1 class="cet">Password Recovery</h1>
    <div class="main-agileinfo">
        <div class="agileits-top">
            <h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown; margin-top: 0; margin-bottom: 25px;">Recover Password</h3>
            
            <?php if(isset($error)){?><div class="errorWrap" style="color: red; padding: 10px; background: #f8d7da; border-radius: 5px; margin-bottom: 20px;"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div><?php } 
                else if(isset($msg)){?><div class="succWrap" style="color: green; padding: 10px; background: #d4edda; border-radius: 5px; margin-bottom: 20px;"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div><?php }?>
            
            <form name="chngpwd" method="post" onSubmit="return valid();">
                <p>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Registered Email" required="">
                </p> 

                <p>
                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Registered Mobile Number" required="">
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
            <p><a href="signin.php">Back to Login</a></p>
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