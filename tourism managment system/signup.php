<?php
session_start();
// database conncetion 
include('./includes/config.php');

if (isset($_POST['submit'])) {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];


    // data insert query
    $query = mysqli_query($conn,"insert into user(name,email,phone,password)values('$name','$email','$phone','$password')");
    if ($query) {

        echo '<script>alert("You have successfully registered")</script>';
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
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


<!--- header ---->

   <div class="main">
    <h1 class="cet">SignUp Form</h1>
    <div class="main-agileinfo">
        <div class="agileits-top">
            <form action="#" method="post">
                
                <!-- Name: minimum 3 letters, only alphabets -->
                <input class="text" type="text" name="name" placeholder="Name" 
                       pattern="[A-Za-z ]{3,}" title="Name must be at least 3 letters and alphabets only" required="">
                
                <!-- Email: HTML5 type=email already validates -->
                <input class="text" type="email" name="email" placeholder="Email" required="">
                
                <!-- Phone: exactly 10 digits -->
                <input class="text" type="text" name="phone" placeholder="Enter phone" 
                       pattern="[0-9]{10}" title="Phone number must be exactly 10 digits" required="">
                
                <!-- Password: minimum 6 characters, at least one letter and one number -->
                <input class="text w3lpass" type="password" name="password" placeholder="Password"
                       
                required="">
                
                <div class="wthree-text">
                    <label class="anim">
                        <input type="checkbox" class="checkbox" required="">
                        <span>I Agree To The Terms & Conditions</span>
                    </label>
                    <div class="clear"></div>
                </div>
                
                <input type="submit" name="submit" value="SIGNUP">
            </form>
            <p>Already have an Account? <a href="signin.php"> Login Now!</a></p>
        </div>
    </div>


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

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="./js/main.js"></script>

</body>
</html>