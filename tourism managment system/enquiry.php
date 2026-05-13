<?php
session_start();
include ('./includes/config.php');

// Check if form is submitted
if ($_POST) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    
    // Insert query
    $sql = "INSERT INTO tblenquiry (FullName, EmailId, MobileNumber, Subject, Description, Status) 
            VALUES ('$fullname', '$email', '$mobile', '$subject', '$description', 0)";
    
    if (mysqli_query($conn, $sql)) {
        $success_message = "Enquiry submitted successfully!";
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Enquiry Form</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" />

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />

    <!-- Font Awesome 7 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" />

    <!-- Custom CSS -->
   <link rel="stylesheet" href="./css.//style.css"> <!-- Corrected path -->
 
</head>

<body>
    <?php include ('./includes/header.php'); ?>
     <!-- Banner Section -->
    <div class="banner-3">
        <div class="container">
            <h1 class="wow zoomIn animated" data-wow-delay=".5s">Enquiry</h1>
        </div>
    </div>
    
    <div class="main-content"> <!-- Main content area -->
        <div class="enquiry-form-container wow fadeInUp"> <!-- Form container with animation -->
            <h2>Enquiry Form</h2> <!-- Form heading -->
            
            <?php if (isset($success_message)) { ?>
                <div class="message success"><?php echo htmlspecialchars($success_message); ?></div> <!-- Success message -->
            <?php } ?>
            
            <?php if (isset($error_message)) { ?>
                <div class="message error"><?php echo htmlspecialchars($error_message); ?></div> <!-- Error message -->
            <?php } ?>
            
            <form method="post" action=""> <!-- Form -->
                <div class="form-group"> <!-- Full Name Group -->
                    <label for="fullname">Full Name:</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>
                
                <div class="form-group"> <!-- Email Group -->
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="form-group"> <!-- Mobile Group -->
                    <label for="mobile">Mobile:</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" maxlength="10" required>
                </div>
                
                <div class="form-group"> <!-- Subject Group -->
                    <label for="subject">Subject:</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                
                <div class="form-group"> <!-- Description Group -->
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>
                
                <button type="submit" class="btn-submit">Submit Enquiry</button> <!-- Submit Button -->
            </form>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include('./includes/footer.php'); ?>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="./js/main.js"></script>

    <script>
        new WOW().init(); // Initialize WOW.js for animations
    </script>
</body>
</html>