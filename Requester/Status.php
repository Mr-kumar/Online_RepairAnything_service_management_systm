<?php
define('TITLE', 'Check status');

include ('includes/common.php');
include ('../db_connection.php');
session_start();

if ($_SESSION['is_login']) {
    $rEmail = $_SESSION['user_email'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_id'])) {
        // Get the request ID submitted by the user
        $request_id = $_POST['request_id'];

        // Check if the provided request ID and user email match
        $query = "SELECT * FROM userrequest_tb WHERE request_id = ? AND requester_email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('is', $request_id, $rEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Request ID belongs to the logged-in user, proceed to fetch work report details
            $query = "SELECT aw.*, tt.* 
                      FROM assignwork_tb aw
                      JOIN technician_tb tt ON aw.tech_id = tt.tech_id
                      WHERE aw.request_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('i', $request_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Work report details found, display them
                $row = $result->fetch_assoc();
                if ($row['status'] == 'Approved') {
                    ?>
                    <div class="container mt-5 col-lg-9">
                        <h2>Work Report Details</h2>
                        <p><strong>Technician Name:</strong> <?php echo $row['tech_name']; ?></p>
                        <p><strong>Technician Email:</strong> <?php echo $row['tech_email']; ?></p>
                        <p><strong>Technician Mobile:</strong> <?php echo $row['tech_mob']; ?></p>
                        <p><em>Technician will be approaching you anytime.</em></p>
                    </div>
                    <?php
                } elseif ($row['status'] == 'Pending') {
                    // No need to display anything for 'Pending' status
                }
            } else {
                // No work report found for the provided request ID
                echo "<div class='container mt-5'>No work report found for the provided request ID.</div>";
            }
        } else {
            // Request ID does not belong to the logged-in user
            echo "<div class='container mt-5'>You are not authorized to view this work report.</div>";
        }
    }
} else {
    // Redirect to the requester login page if not logged in
    echo "<script> location.href ='RequesterLogin.php'</script>";
}
?>

<!-- Request ID form inside a container -->
<div class="container mt-5">
    <h2>Check Work Report Status</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="request_id">Enter Request ID:</label>
            <input type="text" class="form-control" id="request_id" name="request_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include ('includes/footer.php'); ?>