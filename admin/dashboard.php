<?php
define('TITLE', 'Dashboard');
define('PAGE', 'dashboard');
include ('includes/header.php');
include ('../db_connection.php');
session_start();

// Check if admin is logged in
if (isset($_SESSION['is_adminlogin'])) {
    $adminEmail = $_SESSION['aEmail'];
} else {
    // Redirect to admin login page if not logged in
    echo "<script> location.href ='adminlogin.php'</script>";
    exit(); // Exit the script after redirection
}
$sql = "SELECT max(request_id) FROM userrequest_tb";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$submitrequest = $row[0];

$sql = "SELECT max(request_id) FROM assignwork_tb";
$result = $conn->query($sql);
$row = mysqli_fetch_row($result);
$assignwork = $row[0];

$sql = "SELECT * FROM technician_tb";
$result = $conn->query($sql);
$totaltech = $result->num_rows;

?>
<div class="col-sm-9 mt-2">
    <!-- Main Content -->
    <div class="row mx-5 text-center">
        <div class="col-sm-4 mt-5">
            <!-- Card 1 -->
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">Requests Received</div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $submitrequest; ?></h4>
                    <a class="btn text-white" href="userRequest.php">View</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <!-- Card 2 -->
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header">Assigned Work</div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $assignwork; ?></h4>
                    <a class="btn text-white" href="assignwork.php">View</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-5">
            <!-- Card 3 -->
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">No. of Technician</div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $totaltech; ?></h4>
                    <a class="btn text-white" href="technician.php">View</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-5 mt-5 text-center">
        <!-- Table -->
        <p class=" bg-dark text-white p-2">List of Requesters</p>
        <?php
            $sql = "SELECT * FROM user_login";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo '<table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Requester ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<th scope="row">' . $row["user_id"] . '</th>';
                    echo '<td>' . $row["user_name"] . '</td>';
                    echo '<td>' . $row["user_email"] . '</td>';
                    echo '</tr>';
                }
                echo '</tbody></table>';
            } else {
                echo "0 Result";
            }
            ?>
    </div>
</div>

<?php
include ('includes/footer.php');
?>