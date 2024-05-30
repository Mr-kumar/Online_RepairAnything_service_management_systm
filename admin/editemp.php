<?php
define('TITLE', 'Update Technician');
define('PAGE', 'technician');
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

// Update technician details
if (isset($_POST['empupdate'])) {
    // Checking for Empty Fields
    if (empty($_POST['empName']) || empty($_POST['empCity']) || empty($_POST['empMobile']) || empty($_POST['empEmail'])) {
        // Display message if required field is missing
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
    } else {
        // Assigning User Values to Variable
        $eId = $_POST['empId'];
        $eName = $_POST['empName'];
        $eCity = $_POST['empCity'];
        $eMobile = $_POST['empMobile'];
        $eEmail = $_POST['empEmail'];

        // Update SQL query
        $sql = "UPDATE technician_tb SET tech_name = '$eName', tach_city = '$eCity', tech_mob = '$eMobile', tech_email = '$eEmail' WHERE tech_id = '$eId'";

        if ($conn->query($sql) === TRUE) {
            // Display success message
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
        } else {
            // Display error message
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
        }
    }
}

// Fetch technician details for editing
if (isset($_REQUEST['view'])) {
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM technician_tb WHERE tech_id = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>
<div class="col-sm-6 mt-5 mx-auto">
    <div class="jumbotron">
        <h3 class="text-center">Update Technician Details</h3>
        <form action="" method="POST">
            <div class="form-group">
                <label for="empId">Tech ID</label>
                <input type="text" class="form-control" id="empId" name="empId"
                    value="<?php echo isset($row['tech_id']) ? $row['tech_id'] : ''; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="empName">Name</label>
                <input type="text" class="form-control" id="empName" name="empName"
                    value="<?php echo isset($row['tech_name']) ? $row['tech_name'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="empCity">City</label>
                <input type="text" class="form-control" id="empCity" name="empCity"
                    value="<?php echo isset($row['tach_city']) ? $row['tach_city'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="empMobile">Mobile</label>
                <input type="text" class="form-control" id="empMobile" name="empMobile"
                    value="<?php echo isset($row['tech_mob']) ? $row['tech_mob'] : ''; ?>"
                    onkeypress="isInputNumber(event)">
            </div>
            <div class="form-group">
                <label for="empEmail">Email</label>
                <input type="email" class="form-control" id="empEmail" name="empEmail"
                    value="<?php echo isset($row['tech_email']) ? $row['tech_email'] : ''; ?>">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-danger" id="empupdate" name="empupdate">Update</button>
                <a href="technician.php" class="btn btn-secondary">Close</a>
            </div>
            <?php echo $msg; ?>
        </form>
    </div>
</div>
<!-- Only Number for input fields -->
<script>
    function isInputNumber(evt) {
        var ch = String.fromCharCode(evt.which);
        if (!(/[0-9]/.test(ch))) {
            evt.preventDefault();
        }
    }
</script>
<?php
include ('includes/footer.php');
?>