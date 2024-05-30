<?php
define('TITLE', 'WorkReport');
define('PAGE', 'Work_report');
include ('includes/header.php');
include ('../db_connection.php');

// Fetch completed work from the work_report_tb table
$query = "SELECT * FROM work_report_tb WHERE status = 'Completed'";
$result = $conn->query($query);

?>

<div class="container mt-5 col-lg-9">
    <h2>Completed Work Report</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Work Report ID</th>
                    <th>Request ID</th>
                    <th>Assign Date</th>
                    <th>Request Date</th>
                    <th>Technician Email</th>
                    <th>Technician ID</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['work_report_id'] . "</td>";
                        echo "<td>" . $row['request_id'] . "</td>";
                        echo "<td>" . $row['assign_date'] . "</td>";
                        echo "<td>" . $row['request_date'] . "</td>";
                        echo "<td>" . $row['tech_email'] . "</td>";
                        echo "<td>" . $row['tech_id'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No completed work found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include ('includes/footer.php'); ?>