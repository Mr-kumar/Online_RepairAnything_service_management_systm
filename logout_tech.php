<?php
include ('db_connection.php');
session_start();

// Check if technician email is set in session
if (isset($_SESSION['tech_email'])) {
    $techEmail = $_SESSION['tech_email'];

    // Update online status to 0 for the logged-out technician
    $updateSql = "UPDATE technician_tb SET online_status = 0 WHERE tech_email = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("s", $techEmail);

    if ($updateStmt->execute()) {
        echo "Online status updated to 0 for email: $techEmail"; // Debug message
    } else {
        echo "Error updating online status: " . $conn->error; // Debug message
    }
} else {
    echo "Technician email not found in session"; // Debug message
}

// Destroy the session and redirect to index.php
session_destroy();
header("Location: index.php");
exit();
?>