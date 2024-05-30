<?php
define('TITLE', 'Add New Requester');
define('PAGE', 'requesters');
include ('includes/header.php');
include ('../db_connection.php');
session_start();

// Check if admin is logged in
if (!isset($_SESSION['is_adminlogin'])) {
    // Redirect to admin login page if not logged in
    echo "<script> location.href ='adminlogin.php'</script>";
    exit(); // Exit the script after redirection
}

$msg = ''; // Initialize the message variable

// Check if the form is submitted
if (isset($_POST['reqsubmit'])) {
    // Check for empty fields
    if (empty($_POST['r_name']) || empty($_POST['r_email']) || empty($_POST['r_password']) || empty($_POST['r_mobile'])) {
        // Display message if required field is missing
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
    } else {
        // Assign form values to variables
        $rname = $_POST['r_name'];
        $rEmail = $_POST['r_email'];
        $rPassword = $_POST['r_password'];
        $rMobile = $_POST['r_mobile'];

        // SQL query to insert new requester
        $sql = "INSERT INTO user_login (user_name, user_email, user_password, user_mobile) 
                VALUES ('$rname', '$rEmail', '$rPassword', '$rMobile')";

        if ($conn->query($sql) === TRUE) {
            // Display success message
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Added Successfully </div>';
        } else {
            // Display error message
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add </div>';
        }
    }
}
?>
<div class="col-sm-6 mt-5 mx-3 jumbotron">
    <h3 class="text-center">Add New Requester</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="r_name">Name</label>
            <input type="text" class="form-control" id="r_name" name="r_name">
        </div>
        <div class="form-group">
            <label for="r_email">Email</label>
            <input type="email" class="form-control" id="r_email" name="r_email">
        </div>
        <div class="form-group">
            <label for="r_password">Password</label>
            <input type="password" class="form-control" id="r_password" name="r_password">
        </div>
        <div class="form-group">
            <label for="r_mobile">Mobile</label>
            <input type="text" class="form-control" id="r_mobile" name="r_mobile">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="reqsubmit" name="reqsubmit">Submit</button>
            <a href="users.php" class="btn btn-secondary">Close</a>
        </div>
        <?php echo $msg; // Display message   ?>
    </form>
</div>

<?php include ('includes/footer.php'); ?>