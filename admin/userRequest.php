<?php
define('TITLE', 'UserRequest');
define('PAGE', 'userRequest');
include ('includes/header.php');
include ('../db_connection.php');
session_start();
if (isset($_SESSION['is_adminlogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href ='adminlogin.php'</script>";
}
?>

<!-- First and Second Columns (Adjust the grid as needed) -->
<div class="col-md-3 col-lg-3 px-md-4 mt-5">
    <!-- Your existing code here -->
    <?php
    $sql = "SELECT request_id, request_info, request_desc, request_date FROM userrequest_tb";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card mt-3">';
            echo '<div class="card-header">';
            echo 'Request ID: ' . $row['request_id'];
            echo '</div>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Request Info: ' . $row['request_info'] . '</h5>';
            echo '<p class="card-text">' . $row['request_desc'] . '</p>';
            echo '<p class="card-text">Request Date: ' . $row['request_date'] . '</p>';
            echo '<div class="d-flex justify-content-between">';
            // Modify the form action to redirect to assignwork.php with request_id as a URL parameter
            echo '<form action ="assignwork.php" method="GET">';
            echo '<input type="hidden" name="request_id" value="' . $row["request_id"] . '">';
            echo '<input type="submit" class="btn btn-primary" value="View">';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</div>

<?php
include ('includes/footer.php');
?>