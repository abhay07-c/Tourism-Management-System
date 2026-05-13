<?php
session_start();
include('includes/config.php'); 

if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = $_POST['password']; 

    $sql = "SELECT UserName, Password FROM admin WHERE UserName = ? AND Password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $uname, $password); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['login'] = $uname;
        echo "<script> document.location = 'dashboard.php'; </script>";
        exit();
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
    $stmt->close(); 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href=".//css.//style.css">
</head>

<body>
    


 <div class="form_body">
   
    <div class="login-container animated fadeInUp">
        <h2><i class="fas fa-lock"></i> Admin Login</h2>

        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
            </div>

            <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </div>
        </form>
       </div>
 <ul class="bubbles">
    <li></li>
    <li class="square"></li>
    <li></li>
    <li class="square"></li>
    <li></li>
    <li class="square"></li>
    <li></li>
    <li class="square"></li>
</ul>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>