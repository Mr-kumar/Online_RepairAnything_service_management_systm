<?php
define('TITLE', 'Update Password');

include('includes/common.php');
include('../db_connection.php');
session_start();

$passmsg = "";

if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['user_email'];
} else {
    header("Location: RequesterLogin.php"); // Redirect to login page
    exit();
}

if (isset($_POST['updatePassword'])) {
    $newPassword = $_POST['rPassword'];

    if ($newPassword != "") {
        // Update password in the database
        $sql = "UPDATE user_login SET user_password = ? WHERE user_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $newPassword, $rEmail);

        if ($stmt->execute()) {
            $passmsg = "Password updated successfully.";
        } else {
            $passmsg = "Error updating password: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $passmsg = "Please enter a new password.";
    }
}
?>

<div class="col-sm-5 col-md-15">
    <form class="mt-5 mx-5" method="POST" action="">
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" value="<?php echo $rEmail; ?>" readonly>
        </div>
        <div class="form-group mb-2">
            <label for="inputnewpassword">New Password</label>
            <input type="password" class="form-control" id="inputpassword" placeholder="New Password" name="rPassword">
        </div>
        <button type="submit" class="btn btn-primary" name="updatePassword">Update</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>

    <?php
    if ($passmsg != "") {
        echo '<div class="mt-3 alert alert-info">' . $passmsg . '</div>';
    }
    ?>
</div>

<?php include('includes/footer.php'); ?>