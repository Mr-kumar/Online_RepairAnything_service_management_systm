<?php
include('db_connection.php');

if (isset($_POST['rSignup'])) {
    $rName = $_POST['rName'];
    $rEmail = $_POST['rEmail'];
    $rMobile = $_POST['rMobile'];
    $rPassword = $_POST['rPassword'];

    // Check if all required fields are set
    if (!empty($rName) && !empty($rEmail) && !empty($rMobile) && !empty($rPassword)) {
        // Check if email and mobile number are unique
        $checkUnique = "SELECT user_id FROM user_login WHERE user_email = ? OR user_mobile = ?";
        $stmtCheck = $conn->prepare($checkUnique);

        if ($stmtCheck && $stmtCheck->bind_param('ss', $rEmail, $rMobile) && $stmtCheck->execute()) {
            $stmtCheck->store_result();

            if ($stmtCheck->num_rows > 0) {
                // Email or mobile number already exists
                $regmsg = "Email or mobile number already exists. Please use a different email/mobile.";
            } else {
                // Proceed with registration
                $stmtCheck->close();

                $sql = "INSERT INTO user_login (user_name, user_email, user_mobile, user_password) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt && $stmt->bind_param('ssss', $rName, $rEmail, $rMobile, $rPassword) && $stmt->execute() && $stmt->affected_rows > 0) {
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

<!-- Your HTML form remains unchanged, just add the mobile input field -->

<div class="container pt-5" id="Registration">
    <h2 class="text-center">Create an Account</h2>
    <div class="row mt-4 mb-4">
        <div class="col-md-6 offset-md-3">
            <form action="" class="shadow-lg p-4" method="POST">
                <!-- Your existing form fields -->
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <label for="name" class="font-weight-bold pl-2">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="rName" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <label for="email" class="font-weight-bold pl-2">Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="rEmail" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-phone"></i>
                    <label for="mobile" class="font-weight-bold pl-2">Mobile Number</label>
                    <input type="tel" class="form-control" placeholder="Mobile Number" name="rMobile" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <label for="password" class="font-weight-bold pl-2">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="rPassword" required>
                </div>
                <button type="submit" class="btn btn-danger mt-3 btn-block shadow-sm font-weight-bold"
                    name="rSignup">Sign Up</button>
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