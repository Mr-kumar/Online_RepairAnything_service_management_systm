<?php
include ('db_connection.php');

// Array of technician specifications
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

if (isset($_POST['techSignup'])) {
    $techName = $_POST['techName'];
    $techCity = $_POST['techCity'];
    $techMobile = $_POST['techMobile'];
    $techEmail = $_POST['techEmail'];
    $techPassword = $_POST['techPassword'];
    $techSpecification = $_POST['techSpecification']; // New field for technician specification

    // Check if all required fields are set
    if (!empty($techName) && !empty($techCity) && !empty($techMobile) && !empty($techEmail) && !empty($techPassword) && !empty($techSpecification)) {
        // Check if email and mobile number are unique
        $checkUnique = "SELECT tech_id FROM technician_tb WHERE tech_email = ? OR tech_mob = ?";
        $stmtCheck = $conn->prepare($checkUnique);

        if ($stmtCheck && $stmtCheck->bind_param('ss', $techEmail, $techMobile) && $stmtCheck->execute()) {
            $stmtCheck->store_result();

            if ($stmtCheck->num_rows > 0) {
                // Email or mobile number already exists
                $regmsg = "Email or mobile number already exists. Please use a different email/mobile.";
            } else {
                // Proceed with registration
                $stmtCheck->close();

                $sql = "INSERT INTO technician_tb (tech_name, tach_city, tech_mob, tech_email, tech_password, tech_specification) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt && $stmt->bind_param('ssssss', $techName, $techCity, $techMobile, $techEmail, $techPassword, $techSpecification) && $stmt->execute() && $stmt->affected_rows > 0) {
                    // Registration successful
                    $regmsg = "Registration successful!";
                } else {
                    // Registration failed or error in preparing the SQL statement
                    $regmsg = "Registration failed. Please try again.";
                }

                $stmt->close();
            }
        } else {
            // Error in preparing the SQL statement
            $regmsg = "Error in preparing the registration. Please try again.";
        }

        $conn->close();
    } else {
        // Handle missing required fields
        $regmsg = "All fields are mandatory. Please fill in all the required fields.";
    }
}
?>

<!-- HTML form with the dropdown menu for technician specification -->

<div class="container pt-5" id="Registration">
    <h2 class="text-center">Technician Registration</h2>
    <div class="row mt-4 mb-4">
        <div class="col-md-6 offset-md-3">
            <form action="" class="shadow-lg p-4" method="POST">
                <div class="form-group">
                    <i class="fas fa-tools"></i>
                    <label for="specification" class="font-weight-bold pl-2">Specification</label>
                    <!-- Dropdown menu for technician specification -->
                    <select class="form-control" name="techSpecification" required>
                        <option value="">Select Technician Specification</option>
                        <?php foreach ($technicianSpecifications as $specification): ?>
                            <option value="<?php echo $specification; ?>"><?php echo $specification; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Remaining form fields -->
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <label for="name" class="font-weight-bold pl-2">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="techName" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-building"></i>
                    <label for="city" class="font-weight-bold pl-2">City</label>
                    <input type="text" class="form-control" placeholder="City" name="techCity" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-phone"></i>
                    <label for="mobile" class="font-weight-bold pl-2">Mobile Number</label>
                    <input type="tel" class="form-control" placeholder="Mobile Number" name="techMobile" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <label for="email" class="font-weight-bold pl-2">Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="techEmail" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <label for="password" class="font-weight-bold pl-2">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="techPassword" required>
                </div>
                <!-- End of Remaining form fields -->

                <button type="submit" class="btn btn-danger mt-3 btn-block shadow-sm font-weight-bold"
                    name="techSignup">Sign Up</button>
                <?php if (isset($regmsg)): ?>
                    <div class="alert mt-3 <?php echo ($regmsg == 'Registration successful!') ? 'alert-success' : 'alert-danger'; ?>"
                        id="registrationMessage">
                        <?php echo $regmsg; ?>
                    </div>
                    <script>
                        setTimeout(function () {
                            document.getElementById('registrationMessage').style.display = 'none';
                        }, 3000);
                    </script>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>