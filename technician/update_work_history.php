<?php
include ('../db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['complete'])) {
    // Technician marks the repair request as complete
    $request_id = $_POST['request_id'];
    $work_status = "Completed";
    $completion_date = date("Y-m-d"); // Current date

    // Insert data into user_work_history table
    $insert_query = "INSERT INTO user_work_history (request_id, request_info, request_date, assign_date, tech_id, tech_name, tech_email, work_status, completion_date) 
                     SELECT request_id, request_info, request_date, assign_date, tech_id, tech_name, tech_email, ?, ? 
                     FROM assignwork_tb WHERE request_id = ?";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param('ssi', $work_status, $completion_date, $request_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Delete the row from assignwork_tb
        $delete_query = "DELETE FROM assignwork_tb WHERE request_id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param('i', $request_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Update technician availability to 'Available'
            $update_query = "UPDATE technician_tb SET availability = 'Available' WHERE tech_email = (SELECT tech_email FROM assignwork_tb WHERE request_id = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param('i', $request_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Redirect back to the page with a success message
                header("Location: technician_prfile.php?status=success");
                exit();
            } else {
                // Redirect back to the page with an error message
                header("Location: technician_prfile.php?status=error");
                exit();
            }
        } else {
            // Redirect back to the page with an error message
            header("Location: technician_prfile.php?status=error");
            exit();
        }
    } else {
        // Redirect back to the page with an error message
        header("Location: technician_prfile.php?status=error");
        exit();
    }
} else {
    // If the request method is not POST or complete button is not set, redirect back to the page with an error message
    header("Location: technician_prfile.php?status=invalid_request");
    exit();
}
?>