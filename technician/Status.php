<?php
define('TITLE', 'Check status');

include ('includes/common.php');
include ('../db_connection.php');
session_start();

if ($_SESSION['is_tech_login']) {
    $techEmail = $_SESSION['tech_email'];
} else {
    header("Location: technician_login.php"); // Redirect to technician login page
    exit();
}

?>

<!-- start second column -->
<div class="col-sm-4 col-lg-4 mt-3 mx-3">
    <form action="" method="POST" class="form-inline">
        <div class="form-group">
            <label for="checkid">Enter the Request ID:</label>
            <input type="text" class="form-control" name="checkid" id="checkid" onkeypress="isInputNumber(event)">
        </div>
        <button type="submit" class="btn btn-danger mt-3">Search</button>
    </form>

    <?php
    if (isset($_POST['checkid'])) {
        $requestId = $_POST['checkid'];
        // Fetch all records based on technician's tech_id
        $sql = "SELECT * FROM assignwork_tb WHERE assign_tech = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $techEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            ?>
            <h3 class="text-center mt-5">Assigned Work Details</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Request Info</th>
                        <th>Request Description</th>
                        <!-- Add more table headings for other details as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['request_id']; ?>
                            </td>
                            <td>
                                <?php echo $row['request_info']; ?>
                            </td>
                            <td>
                                <?php echo $row['request_desc']; ?>
                            </td>
                            <!-- Add more table cells for other details as needed -->
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <div class="text-center">
                <form action="" class="mb-3 d-print-none">
                    <input type="submit" class="btn btn-danger" value="Print" onclick="window.print()">
                    <input type="submit" class="btn btn-secondary" value="Close">
                </form>
            </div>
            <?php
        } else {
            echo "<p>No records found for the logged-in technician.</p>";
        }

        $stmt->close();
    }
    ?>
</div>
<script>
    function isInputNumber(evt) {
        var ch = String.fromCharCode(evt.which);
        if (!(/[0-9]/.test(ch))) {
            evt.preventDefault();
        }
    }
</script>

<?php include ('includes/footer.php'); ?>