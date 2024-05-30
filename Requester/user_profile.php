<?php
define('TITLE', 'Requester Profile');
include ('includes/common.php');

include ('../db_connection.php');
session_start();

if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['user_email'];
} else {
    header("Location: RequesterLogin.php"); // Redirect to login page
    exit();
}

$sql = "SELECT user_name, user_email, user_mobile, user_id FROM user_login WHERE user_email = '$rEmail'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $rName = $row['user_name'];
    $rMobile = $row['user_mobile'];
    $rUserID = $row['user_id'];
}

// Update the name code is from here
$updateMessage = ""; // Initialize the variable

if (isset($_POST['updatename'])) {
    $newName = $_POST['rName'];

    if ($newName == "") {
        $updateMessage = "Fill all fields";
    } else {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("UPDATE user_login SET user_name = ? WHERE user_email = ?");
        $stmt->bind_param("ss", $newName, $rEmail);

        if ($stmt->execute()) {
            $updateMessage = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Updated name</div>';
        } else {
            $updateMessage = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Error updating name</div>';
        }

        $stmt->close();
    }
}

?>

<div class="col-md-4 mt-4 mx-auto">
    <form method="POST">
        <div class="mb-3">
            <label for="rUserID" class="form-label">User ID</label>
            <input type="text" class="form-control" name="rUserID" id="rUserID" value="<?php echo $rUserID ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="rEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" name="rEmail" id="rEmail" value="<?php echo $rEmail ?>" readonly>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="rName" class="form-label">Name</label>
            <input type="text" name="rName" class="form-control" id="rName" value="<?php echo $rName ?>">
            <div class="text-danger">
                <?php echo $updateMessage; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="rMobile" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" name="rMobile" id="rMobile" value="<?php echo $rMobile ?>" readonly>
        </div>
        <button type="submit" class="btn btn-primary" name="updatename">Update</button>
    </form>
</div>
<?php include ('includes/footer.php'); ?>