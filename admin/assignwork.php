<?php
define('TITLE', 'Assign Work');
define('PAGE', 'Assign Work');
include ('includes/header.php');
include ('../db_connection.php');
session_start();

// Check if request ID is provided in the URL
if (isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];

    // Retrieve information about the request using the request ID
    $sql = "SELECT * FROM userrequest_tb WHERE request_id = $request_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display the information in a card
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-9">';
            echo '<div class="container mt-5">';
            echo '<div class="card">';
            echo '<div class="card-header">Request ID: ' . $row['request_id'] . '</div>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Request Info: ' . $row['request_info'] . '</h5>';
            echo '<p class="card-text">Request Description: ' . $row['request_desc'] . '</p>';
            // Display all other attributes from the table
            foreach ($row as $key => $value) {
                if ($key != 'request_id' && $key != 'request_info' && $key != 'request_desc') {
                    echo '<p class="card-text">' . ucfirst(str_replace('_', ' ', $key)) . ': ' . $value . '</p>';
                }
            }
            // Add form for adding technician and assign date
            echo '<form action="assignwork_process.php" method="POST">';
            echo '<div class="form-group">';
            echo '<label for="technician">Add Technician:</label>';
            // Display the selected technician's name in the field
            if (isset($_GET['tech_name'])) {
                $technician_name = $_GET['tech_name'];
                echo '<input type="text" class="form-control" id="technician" name="technician" value="' . $technician_name . '" readonly>';
            } else {
                echo '<input type="text" class="form-control" id="technician" name="technician">';
            }
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="technician_id">Technician ID:</label>';
            echo '<input type="text" class="form-control" id="technician_id" name="technician_id" value="' . $_GET['tech_id'] . '" readonly>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="technician_email">Technician Email:</label>';
            echo '<input type="text" class="form-control" id="technician_email" name="technician_email" value="' . $_GET['tech_email'] . '" readonly>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="technician_mobile">Technician Mobile:</label>';
            echo '<input type="text" class="form-control" id="technician_mobile" name="technician_mobile" value="' . $_GET['tech_mob'] . '" readonly>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="assign_date">Assign Date:</label>';
            echo '<input type="date" class="form-control" id="assign_date" name="assign_date">';
            echo '</div>';
            echo '<input type="hidden" name="request_id" value="' . $request_id . '">';
            echo '<a href="view_technicians.php?request_id=' . $request_id . '&technician_name=' . urlencode($_GET['tech_name']) . '" class="btn btn-primary mr-2">Add Technician</a>';
            echo '<button type="submit" class="btn btn-primary">Assign Work</button>';
            echo '</form>';
            echo '</div>'; // card-body
            echo '</div>'; // card
            echo '</div>'; // container
            echo '</div>'; // col-md-9
        }
    } else {
        echo "<div class='container mt-5'>No information found for the selected request.</div>";
    }
} else {
    echo "<div class='container mt-5'>Request ID not provided.</div>";
}

include ('includes/footer.php');