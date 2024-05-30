<?php
define('TITLE', 'View Technicians');
define('PAGE', 'View Technicians');
include ('includes/header.php');
include ('../db_connection.php');
session_start();

// Check if request ID is provided in the URL
if (isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];

    // Fetch online and available technicians from the database
    $sql = "SELECT * FROM technician_tb WHERE online_status = 1 AND availability = 'Available'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="container mt-5 col-lg-9">';
        echo '<h2 class="text-center">Online and Available Technicians</h2>';
        echo '<table class="table mt-3">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th scope="col">Technician ID</th>';
        echo '<th scope="col">Technician Name</th>';
        echo '<th scope="col">City</th>';
        echo '<th scope="col">Mobile</th>';
        echo '<th scope="col">Email</th>';
        echo '<th scope="col">Specialization</th>';
        echo '<th scope="col">Select</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['tech_id'] . '</td>';
            echo '<td>' . $row['tech_name'] . '</td>';
            echo '<td>' . $row['tach_city'] . '</td>';
            echo '<td>' . $row['tech_mob'] . '</td>';
            echo '<td>' . $row['tech_email'] . '</td>';
            echo '<td>' . $row['tech_specification'] . '</td>';
            echo '<td><a href="assignwork.php?request_id=' . $request_id . '&tech_id=' . $row['tech_id'] . '&tech_name=' . $row['tech_name'] . '&tech_city=' . $row['tach_city'] . '&tech_mob=' . $row['tech_mob'] . '&tech_email=' . $row['tech_email'] . '" class="btn btn-primary">Select</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>'; // container
    } else {
        echo "<div class='container mt-5'>No online and available technicians found.</div>";
    }
} else {
    echo "<div class='container mt-5'>Request ID not provided.</div>";
}

include ('includes/footer.php');
?>