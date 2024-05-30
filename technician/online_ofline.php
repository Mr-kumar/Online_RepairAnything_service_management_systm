<?php
define('TITLE', 'Technician details');
include('includes/common.php');

include('../db_connection.php');
session_start();

// Check if technician is logged in
if (!isset($_SESSION['is_tech_login']) || !$_SESSION['is_tech_login']) {
    header("Location: technician_login.php");
    exit();
}

// Retrieve technician's email from session
$techEmail = $_SESSION['tech_email'];

// Fetch technician details from the database
$sql = "SELECT tech_name, online_status FROM technician_tb WHERE tech_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $techEmail);
$stmt->execute();
$result = $stmt->get_result();

$techName = "";
$currentStatus = "";

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $techName = $row['tech_name'];
    $currentStatus = $row['online_status'];
}

// Handle status update button click
if (isset($_POST['updateStatus'])) {
    // Ensure that only logged-in technician can update status
    if ($_SESSION['tech_email'] == $techEmail) {
        $newStatus = $currentStatus == '1' ? '0' : '1';

        $sql = "UPDATE technician_tb SET online_status = ? WHERE tech_email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $newStatus, $techEmail);
        if ($stmt->execute()) {
            $currentStatus = $newStatus;
        } else {
            echo '<div class="alert alert-danger" role="alert">Error updating status</div>';
        }
        $stmt->close();
    }
}
?>

<!-- Technician Profile -->
<div class="col-sm-6 col-md-15 col-lg-8">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h2 class="my-4 text-center"><?php echo TITLE; ?></h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Technician Details</h5>
                        <p class="card-text"><strong>Name:</strong> <?php echo $techName; ?></p>
                        <p class="card-text"><strong>Status:</strong> 
                            <span class="badge <?php echo $currentStatus == '1' ? 'bg-success' : 'bg-secondary'; ?>">
                                <?php echo $currentStatus == '1' ? 'Online' : 'Offline'; ?>
                            </span>
                        </p>
                        <!-- Form for updating status -->
                        <form method="POST">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="updateStatus">
                                    <?php echo $currentStatus == '1' ? 'Go Offline' : 'Go Online'; ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
