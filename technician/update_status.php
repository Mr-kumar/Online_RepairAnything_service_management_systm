<?php
include ('../db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accept'])) {
        // Technician accepts the repair request
        $request_id = $_POST['request_id'];
        $status = "Approved";

        // Update status in the assignwork_tb table
        $update_query = "UPDATE assignwork_tb SET status = ? WHERE request_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('si', $status, $request_id);
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
    } elseif (isset($_POST['complete'])) {
        // Technician marks the repair request as complete
        $request_id = $_POST['request_id'];
        $status = "Completed";

        // Update status in the assignwork_tb table
        $update_query = "UPDATE assignwork_tb SET status = ? WHERE request_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('si', $status, $request_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Retrieve technician ID
            $select_query = "SELECT tech_id FROM assignwork_tb WHERE request_id = ?";
            $stmt = $conn->prepare($select_query);
            $stmt->bind_param('i', $request_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $tech_id = $row['tech_id'];

            // Update technician availability to 'free' in technician_tb
            $update_availability_query = "UPDATE technician_tb SET availability = 'Available' WHERE tech_id = ?";
            $stmt = $conn->prepare($update_availability_query);
            $stmt->bind_param('i', $tech_id);
            $stmt->execute();

            // Insert completed request information into work_report_tb
            $insert_query = "INSERT INTO work_report_tb (request_id, assign_date, request_date, tech_id, tech_email, status) 
                             SELECT request_id, assign_date, request_date, tech_id, tech_email, ? 
                             FROM assignwork_tb WHERE request_id = ?";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param('si', $status, $request_id);
            $stmt->execute();

            // Delete the completed request from assignwork_tb
            $delete_query = "DELETE FROM assignwork_tb WHERE request_id = ?";
            $stmt = $conn->prepare($delete_query);
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
    }
} else {
    // If the request method is not POST, redirect back to the page with an error message
    header("Location: technician_prfile.php?status=invalid_request");
    exit();
}
?>