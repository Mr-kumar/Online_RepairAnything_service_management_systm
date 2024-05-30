<?php
define('TITLE', 'Technician Profile');
include ('includes/common.php');

include ('../db_connection.php');
session_start();

if (!isset($_SESSION['is_tech_login']) || !$_SESSION['is_tech_login']) {
    header("Location: technician_login.php"); // Redirect to technician login page if not logged in
    exit();
}

$techEmail = $_SESSION['tech_email'];

$sql = "SELECT tech_name, tech_email, tech_mob, tech_id FROM technician_tb WHERE tech_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $techEmail);
$stmt->execute();
$result = $stmt->get_result();

$techID = ""; // Initialize techID variable
$techName = ""; // Initialize techName variable

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $techName = $row['tech_name'];
    $techMobile = $row['tech_mob'];
    $techID = $row['tech_id'];
}

// Update the name code is from here
$updateMessage = ""; // Initialize the variable

if (isset($_POST['updatename'])) {
    $newName = $_POST['techName'];

    if ($newName == "") {
        $updateMessage = "Fill all fields";
    } else {
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("UPDATE technician_tb SET tech_name = ? WHERE tech_email = ?");
        $stmt->bind_param("ss", $newName, $techEmail);

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
            <label for="techID" class="form-label">Technician ID</label>
            <input type="text" class="form-control" name="techID" id="techID" value="<?php echo $techID ?>" readonly>
        </div>
        <!-- Rest of the form remains unchanged -->
        <div class="mb-3">
            <label for="techName" class="form-label">Name</label>
            <input type="text" name="techName" class="form-control" id="techName" value="<?php echo $techName ?>">
            <div class="text-danger">
                <?php echo $updateMessage; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="techMobile" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" name="techMobile" id="techMobile" value="<?php echo $techMobile ?>"
                readonly>
        </div>
        <button type="submit" class="btn btn-primary" name="updatename">Update</button>
    </form>
</div>
<?php include ('includes/footer.php'); ?>