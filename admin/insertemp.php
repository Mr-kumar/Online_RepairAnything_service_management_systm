<?php
define('TITLE', 'Add New Technician');
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

if (isset($_POST['empsubmit'])) {
    // Check for empty fields
    if (empty($_POST['empName']) || empty($_POST['empCity']) || empty($_POST['empMobile']) || empty($_POST['empEmail']) || empty($_POST['empPassword'])) {
        // Display message if required field is missing
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert">Fill All Fields</div>';
    } else {
        // Sanitize and assign input values to variables
        $tech_name = mysqli_real_escape_string($conn, $_POST['empName']);
        $tech_city = mysqli_real_escape_string($conn, $_POST['empCity']);
        $tech_mob = mysqli_real_escape_string($conn, $_POST['empMobile']);
        $tech_email = mysqli_real_escape_string($conn, $_POST['empEmail']);
        $tech_password = mysqli_real_escape_string($conn, $_POST['empPassword']);

        // Prepare and execute SQL query
        $sql = "INSERT INTO technician_tb (tech_id, tach_city, tech_name, tech_email, tech_mob, tech_password) 
                VALUES (NULL, '$tech_city', '$tech_name', '$tech_email', '$tech_mob', '$tech_password')";

        if ($conn->query($sql) === TRUE) {
            // Display success message
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert">Added Successfully</div>';
        } else {
            // Display error message
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert">Unable to Add</div>';
        }
    }
}
?>

<div class="col-sm-4 mt-5 mx-auto">
    <div class="jumbotron shadow text-center">
        <h3 class="mb-4">Add New Technician</h3>
        <form action="" method="POST">
            <div class="form-group">
                <label for="empName">Name</label>
                <input type="text" class="form-control" id="empName" name="empName">
            </div>
            <div class="form-group">
                <label for="empCity">City</label>
                <input type="text" class="form-control" id="empCity" name="empCity">
            </div>
            <div class="form-group">
                <label for="empMobile">Mobile</label>
                <input type="text" class="form-control" id="empMobile" name="empMobile"
                    onkeypress="isInputNumber(event)">
            </div>
            <div class="form-group">
                <label for="empEmail">Email</label>
                <input type="email" class="form-control" id="empEmail" name="empEmail">
            </div>
            <div class="form-group">
                <label for="empPassword">Password</label>
                <input type="password" class="form-control" id="empPassword" name="empPassword">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-danger" id="empsubmit" name="empsubmit">Submit</button>
                <a href="technician.php" class="btn btn-secondary">Close</a>
            </div>
            <?php echo $msg; // Display message  ?>
        </form>
    </div>
</div>

<!-- Script to allow only numbers for input fields -->
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