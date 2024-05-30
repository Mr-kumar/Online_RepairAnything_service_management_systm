<?php
include('../db_connection.php');
session_start();

$msg = ""; // Initialize the message variable

if (isset($_POST['rEmail'])) {
    $rEmail = mysqli_real_escape_string($conn, trim($_POST['rEmail']));
    $rPassword = mysqli_real_escape_string($conn, trim($_POST['rPassword']));

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT user_password FROM user_login WHERE user_email = ? LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $rEmail);
    $stmt->execute();
    $stmt->store_result();

    // echo $stmt->bind_result($storedPassword);
    // echo $stmt->num_rows;

    if ($stmt->num_rows == 1) {
        // If user exists, verify the password
        $stmt->bind_result($storedPassword);
        $stmt->fetch();

        if ($rPassword == $storedPassword) {
            // Password is correct, login successful
            $_SESSION['is_login'] = true;
            $_SESSION['user_email'] = $rEmail;

            // Redirect to user_profile.php
            header("Location: user_profile.php");
            exit();
        } else {
            // Password is incorrect
            $msg = "Login failed. Incorrect password.";
        }
    } else {
        // User does not exist
        $msg = "Login failed. User does not exist.";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">
    <title>Login</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3 text-center mt-5" style="font-size: 30px;">
                    <i class="fas fa-stethoscope"></i>
                    <span>Online Maintenance Management System</span>
                </div>
                <p class="text-center" style="font-size: 20px;"> <i class="fas fa-user-secret text-danger"></i>
                    <span>Requester
                        Area(Demo)</span>
                </p>

                <!-- Display the message below the form -->
                <?php if ($msg != ""): ?>
                <div class="alert alert-<?php echo ($msg == "Login successful") ? "success" : "danger"; ?> mt-2"
                    role="alert">
                    <?php echo $msg; ?>
                </div>
                <?php endif; ?>

                <form action="" class="shadow-lg p-4" method="POST">
                    <div class="form-group">
                        <i class="fas fa-user"></i><label for="email" class="pl-2 font-weight-bold">Email</label><input
                            type="email" class="form-control" placeholder="Email" name="rEmail">
                        <small class="form-text">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">Password</label><input
                            type="password" class="form-control" placeholder="Password" name="rPassword">
                    </div>

                    <div> <input type="checkbox" name="check"> Remember me</div>

                    <input type="submit" class="btn btn-outline-danger mt-3 btn-block shadow-sm font-weight-bold"
                        name="login">
                </form>
                <div class="text-center"><a class="btn btn-info mt-3 shadow-sm font-weight-bold"
                        href="../index.php">Back to Home</a>
                </div>
            </div>
            <!-- Add your additional content in the remaining 6 columns here -->
            <div class="col-md-6">
                <!-- Additional content goes here -->
            </div>
        </div>
    </div>

    <!-- Boostrap JavaScript -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
</body>

</html>