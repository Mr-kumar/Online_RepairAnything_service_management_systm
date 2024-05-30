<?php
define('TITLE', 'Change Password');
define('PAGE', 'changepassword');
include ('includes/header.php');
include ('../db_connection.php');
session_start();

// Redirect to admin login page if not logged in
if (!isset($_SESSION['is_adminlogin']) || $_SESSION['is_adminlogin'] !== true) {
    echo "<script>location.href ='adminlogin.php'</script>";
    exit();
}

$adminEmail = $_SESSION['aEmail'];
$passmsg = '';

if (isset($_POST['passupdate'])) {
    $newPassword = $_POST['aPassword'];

    if (!empty($newPassword)) {
        $sql = "UPDATE adminlogin SET admin_password = '$newPassword' WHERE admin_email = '$adminEmail'";
        if ($conn->query($sql) === TRUE) {
            $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Password Updated Successfully</div>';
        } else {
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Update Password</div>';
        }
    } else {
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Please Enter New Password</div>';
    }
}
?>
<div class="col-sm-9 col-md-10 col-lg-9">
    <div class="row">
        <div class="col-sm-6 mx-auto mt-5">
            <div class="shadow p-4 rounded">
                <form class="mt-5" method="post" action="">
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" value="<?php echo $adminEmail ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="inputNewPassword">New Password</label>
                        <input type="password" class="form-control" id="inputNewPassword" placeholder="New Password"
                            name="aPassword" autocomplete="new-password">
                    </div>
                    <button type="submit" class="btn btn-danger mr-4 mt-4" name="passupdate">Update</button>
                    <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                    <?php echo $passmsg; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include ('includes/footer.php'); ?>