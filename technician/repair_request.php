<?php
define('TITLE', 'Assigned Repair Requests');
include ('includes/common.php');
include ('../db_connection.php');
session_start();

// Check if the technician is logged in
if ($_SESSION['is_tech_login']) {
    $techEmail = $_SESSION['tech_email'];

    // Fetch assigned repair requests for the technician along with all user request details
    $query = "SELECT aw.request_id, ur.* 
              FROM assignwork_tb aw
              JOIN userrequest_tb ur ON aw.request_id = ur.request_id 
              WHERE aw.tech_email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $techEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    ?>

<!-- Main content area (col-md-8) -->
<div class="col-md-8">
    <h2>Assigned Repair Requests</h2>
    <div class="container-fluid">
        <div class="row">
            <?php
                // Display assigned repair requests as cards
                while ($row = $result->fetch_assoc()) {
                    ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">Request ID: <?php echo $row['request_id']; ?></div>
                    <div class="card-body">
                        <!-- Loop through all columns from userrequest_tb and display in the card -->
                        <?php
                                foreach ($row as $key => $value) {
                                    echo "<p class='card-text'>" . ucfirst(str_replace('_', ' ', $key)) . ": $value</p>";
                                }
                                ?>
                        <!-- Button for Completing the Repair Request -->
                        <div class="mt-3">
                            <form action="update_status.php" method="post">
                                <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                                <button type="submit" class="btn btn-success" name="accept">Accept</button>
                                <button type="submit" class="btn btn-primary" name="complete">Complete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
                ?>
        </div>
    </div>
</div>


<?php
} else {
    header("Location: technician_login.php"); // Redirect to technician login page
    exit();
}
?>
<?php include ('includes/footer.php'); ?>