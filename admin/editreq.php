<?php
define('TITLE', 'Update Requester');
define('PAGE', 'users');
include ('includes/header.php');
include ('../db_connection.php');

session_start();

// Check if admin is logged in
if (isset($_SESSION['is_adminlogin'])) {
    $adminEmail = $_SESSION['aEmail'];
} else {
    // Redirect to admin login page if not logged in
    echo "<script> location.href ='adminlogin.php'</script>";
    exit(); // Exit the script after redirection
}

// Update requester details
if (isset($_POST['requpdate'])) {
    // Check for empty fields
    if (empty($_POST['user_id']) || empty($_POST['user_name']) || empty($_POST['user_email'])) {
        // Display message if required field is missing
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
    } else {
        // Get input values
        $rid = $_POST['user_id'];
        $rname = $_POST['user_name'];
        $remail = $_POST['user_email'];

        // Update SQL query
        $sql = "UPDATE requesterlogin_tb SET user_name = '$rname', user_email = '$remail' WHERE user_id = '$rid'";
        if ($conn->query($sql) === TRUE) {
            // Display success message if update is successful
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Updated Successfully</div>';
        } else {
            // Display error message if update fails
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update</div>';
        }
    }
}

?>
<div class="col-sm-6 mt-5 mx-auto jumbotron">
    <h3 class="text-center">Update Requester Details</h3>
    <?php
    if (isset($_REQUEST['view'])) {
        $rid = $_REQUEST['id'];
        // Fetch requester details
        $sql = "SELECT * FROM user_login WHERE user_id = '$rid'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="user_id">Requester ID</label>
            <input type="text" class="form-control" id="user_id" name="user_id"
                value="<?php echo $row['user_id'] ?? ''; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="user_name">Name</label>
            <input type="text" class="form-control" id="user_name" name="user_name"
                value="<?php echo $row['user_name'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="user_email">Email</label>
            <input type="text" class="form-control" id="user_email" name="user_email"
                value="<?php echo $row['user_email'] ?? ''; ?>">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger" id="requpdate" name="requpdate">Update</button>
            <a href="users.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if (isset($msg)) {
            echo $msg;
        } ?>
    </form>
</div>

<?php
include ('includes/footer.php');
?>