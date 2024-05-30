<?php
define('TITLE', 'Technician');
define('PAGE', 'technician');

include ('includes/header.php');
include ('../db_connection.php');
session_start();

// Check if admin is logged in
if (!isset($_SESSION['is_adminlogin'])) {
    // Redirect to admin login page if not logged in
    echo "<script> location.href ='adminlogin.php'</script>";
    exit(); // Exit the script after redirection
}

// Check if request ID is provided in the URL
if (isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];
}

// Function to fetch technicians for a given specification
function fetchTechnicians($conn, $specification)
{
    $output = '';
    $sql = "SELECT * FROM technician_tb WHERE tech_specification LIKE '%$specification%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $output .= '<tr>';
            $output .= '<td>' . $row['tech_id'] . '</td>';
            $output .= '<td>' . $row['tech_name'] . '</td>';
            $output .= '<td>' . $row['tech_city'] . '</td>';
            $output .= '<td>' . $row['tech_mobile'] . '</td>';
            $output .= '<td>' . $row['tech_email'] . '</td>';
            $output .= '<td><button class="btn btn-primary select-technician" data-techid="' . $row['tech_id'] . '" data-techname="' . $row['tech_name'] . '">Select</button></td>';
            $output .= '</tr>';
        }
    } else {
        $output .= '<tr><td colspan="6">No technicians available for this specification.</td></tr>';
    }
    return $output;
}
?>

<div class="col-md-9">
    <div class="row">
        <!-- Display cards for each technician specification -->
        <?php
        $technicianSpecifications = array(
            "Electrical Repair",
            "Plumbing Repair",
            "HVAC Repair",
            "Appliance Repair",
            "Electronics Repair",
            "Carpentry",
            "Automotive Repair",
            "Computer Repair",
            "Mobile Phone Repair"
        );
        foreach ($technicianSpecifications as $specification):
            ?>
        <div class="col-sm-6 col-md-4 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $specification; ?></h5>
                    <?php
                        // Count technicians for the current specification
                        $sql = "SELECT COUNT(*) as count FROM technician_tb WHERE tech_specification LIKE '%$specification%'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $technicianCount = $row['count'];
                        ?>
                    <p class="card-text">Technicians: <?php echo $technicianCount; ?></p>
                    <button class="btn btn-primary view-technicians"
                        data-specification="<?php echo $specification; ?>">View Technicians</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Display table of technicians dynamically -->
    <div class="mt-5" id="technician-table-container" style="display: none;">
        <h2 class="text-center">Technicians</h2>
        <table class="table mt-3" id="technician-table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Tech ID</th>
                    <th scope="col">Tech Name</th>
                    <th scope="col">City</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="technician-table-body">
                <?php echo fetchTechnicians($conn, 'Electrical Repair'); ?>
            </tbody>
        </table>
    </div>
</div>

<?php include ('includes/footer.php') ?>

<script>
// Event listener for clicking on "View Technicians" button
$('.view-technicians').click(function() {
    var specification = $(this).data('specification');
    fetchTechnicians(specification);
});

// Function to fetch technicians for a given specification using AJAX
function fetchTechnicians(specification) {
    $.ajax({
        url: 'fetch_technicians.php',
        type: 'POST',
        data: {
            specification: specification
        },
        success: function(response) {
            $('#technician-table-body').html(response);
            $('#technician-table-container').show();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

// Event listener for clicking on "Select Technician" button
$(document).on('click', '.select-technician', function() {
    var techId = $(this).data('techid');
    var techName = $(this).data('techname');
    // Redirect back to assignwork.php with selected technician's ID and name as parameters
    window.location.href = 'assignwork.php?request_id=<?php echo $request_id; ?>&technician_id=' + techId +
        '&technician_name=' + techName;
});
</script>