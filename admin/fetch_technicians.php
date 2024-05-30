<?php
// Include database connection
include ('../db_connection.php');

// Check if specification is set in POST request
if (isset($_POST['specification'])) {
    $specification = $_POST['specification'];

    // Fetch technicians for the given specification
    $sql = "SELECT * FROM technician_tb WHERE tech_specification LIKE '%$specification%'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Output technicians' list as HTML table rows
        while ($row = $result->fetch_assoc()) {
            $online_status = $row['online_status']; // Assuming 'online_status' is the field in the database

            // Determine the online status display
            $online_status_display = ($online_status == 1) ? '<span style="color: #28a745;">Online <span style="font-size: 8px; margin-left: 3px;">&bull;</span></span>' : '<span style="color: #dc3545;">Offline</span>';

            echo '<tr>';
            echo '<td>' . $row['tech_id'] . '</td>';
            echo '<td>' . $row['tech_name'] . '</td>';
            echo '<td>' . $row['tach_city'] . '</td>';
            echo '<td>' . $row['tech_mob'] . '</td>';
            echo '<td>' . $row['tech_email'] . '</td>';
            echo '<td>' . $online_status_display . '</td>'; // Display online status
            echo '</tr>';
        }
    } else {
        // Output message if no technicians found for the given specification
        echo '<tr><td colspan="6">No Technicians Found</td></tr>';
    }
} else {
    // Output error message if specification is not set
    echo '<tr><td colspan="6">Error: Specification not provided</td></tr>';
}
?>