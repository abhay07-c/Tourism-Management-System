<?php
session_start();
include('./includes/config.php');

// If the user is not logged in, redirect to login page
if (!isset($_SESSION['login'])) {
    header('location: signin.php');
    exit();
}

$useremail = $_SESSION['login'];

// Handle form submission
if (isset($_POST['submit_issue'])) {
    $issue = $_POST['issue'];
    $description = $_POST['description'];
    
    $query = mysqli_query($conn, "INSERT INTO tblissues(UserEmail, Issue, Description) VALUES('$useremail', '$issue', '$description')");
    
    if ($query) {
        $msg = "Issue submitted successfully!";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

// Fetch user's issues
$issues_query = mysqli_query($conn, "SELECT * FROM tblissues WHERE UserEmail='$useremail' ORDER BY PostingDate DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System - Issue Tickets</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <!----- custome css --->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<?php include('./includes/header.php'); ?>

<div class="container mt-5">
    <h2 class="text-center wow fadeInDown">Submit an Issue Ticket</h2>

    <!-- Display Success or Error Messages -->
    <?php if (isset($msg)) { echo "<div class='alert alert-success text-center'>$msg</div>"; } ?>
    <?php if (isset($error)) { echo "<div class='alert alert-danger text-center'>$error</div>"; } ?>

    <!-- Submit Issue Form -->
    <div class="well wow fadeInUp">
        <form method="post">
            <div class="form-group">
                <label for="issue">Issue Title:</label>
                <input type="text" name="issue" id="issue" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="5" class="form-control" required></textarea>
            </div>
            <button type="submit" name="submit_issue" class="btn btn-primary">Submit Issue</button>
        </form>
    </div>

    <!-- Display Submitted Issues -->
    <h3 class="text-center mt-5 wow fadeIn">Your Submitted Issues</h3>
    <table class="table table-bordered table-striped wow fadeInUp">
        <thead>
            <tr>
                <th>#</th>
                <th>Issue</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
                <th>Admin Reply</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $cnt = 1;
            while ($row = mysqli_fetch_array($issues_query)) {
                ?>
                <tr>
                    <td><?php echo $cnt++; ?></td>
                    <td><?php echo $row['Issue']; ?></td>
                    <td><?php echo $row['Description']; ?></td>
                    <td><?php echo $row['PostingDate']; ?></td>
                    <td>
                        <?php if ($row['AdminRemark'] == '') { ?>
                            <span class="label label-warning">Pending</span>
                        <?php } else { ?>
                            <span class="label label-success">Replied</span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($row['AdminRemark'] != '') { ?>
                            <button class="btn btn-info btn-sm" onclick="showReply('<?php echo addslashes($row['AdminRemark']); ?>', '<?php echo $row['AdminremarkDate']; ?>')">
                                View Reply
                            </button>
                        <?php } else { ?>
                            No reply yet
                        <?php } ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal for Admin Reply -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Admin Reply</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="replyContent">
                <!-- Content will be inserted here by JS -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

    function showReply(reply, date) {
        var content = '<p><strong>Reply Date:</strong> ' + date + '</p>';
        content += '<div class="admin-reply-content"><p>' + reply + '</p></div>';
        document.getElementById('replyContent').innerHTML = content;
        $('#replyModal').modal('show');
    }
</script>

<!-- Basic Custom Styling -->


</body>
</html>