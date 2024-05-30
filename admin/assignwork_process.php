<?php
include ('../db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST['technician_id']) && !empty($_POST['assign_date']) && !empty($_POST['request_id'])) {
        // Retrieve form data
        $request_id = $_POST['request_id'];
        $technician_id = $_POST['technician_id'];
        $assign_date = $_POST['assign_date'];
        // Get the current date for the request_date field
        $request_date = date("Y-m-d");
        // Assuming user_email is the requester's email

        // Assuming tech_email is the technician's email
        $tech_email = $_POST['technician_email'];
        // Status is set to Pending by default
        $status = "Pending";

        // Perform insert into assignwork_tb table
        $sql = "INSERT INTO assignwork_tb (tech_id, request_id, assign_date, request_date,  tech_email, status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // Remove one '?' from the bind_param
        $stmt->bind_param("iissss", $technician_id, $request_id, $assign_date, $request_date, $tech_email, $status);
        $stmt->execute();

        // Check if insertion was successful
        if ($stmt->affected_rows > 0) {
            // Update technician availability to 'Not Free'
            $updateSql = "UPDATE technician_tb SET availability = 'Not Free' WHERE tech_id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("i", $technician_id);
            $updateStmt->execute();

            // Redirect to a success page
            header("Location: userRequest.php");
            exit();
        } else {
            // Redirect to an error page
            header("Location: error.php");
            exit();
        }
    } else {
        // Redirect back to the form page with an error message
        header("Location: assignwork.php?error=empty_fields");
        exit();
    }
} else {
    // Redirect back to the form page with an error message
    header("Location: assignwork.php?error=invalid_request");
    exit();
}
?>