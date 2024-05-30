<?php
include('../db_connection.php');
session_start();

// Check if the user is already logged in
if (isset($_SESSION['is_adminlogin'])) {
    header("Location: dashboard.php");
    exit();
}

$loginError = ''; // Initialize login error message

// Check if the login form is submitted
if (isset($_POST['login'])) {
    // Sanitize and retrieve form data
    $aEmail = mysqli_real_escape_string($conn, trim($_POST['aEmail']));
    $aPassword = mysqli_real_escape_string($conn, trim($_POST['aPassword']));

    // Query to check admin credentials
    $sql = "SELECT admin_email, admin_password FROM adminlogin WHERE admin_email ='$aEmail' AND admin_password ='$aPassword' LIMIT 1";
    $result = $conn->query($sql);

    // If credentials are valid, set session and redirect
    if ($result && $result->num_rows == 1) {
        $_SESSION['is_adminlogin'] = true;
        $_SESSION['aEmail'] = $aEmail;
        header("Location: dashboard.php");
        exit();
    } else {
        $loginError = "Invalid login credentials. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">
    <style>
        .custom-margin {
            margin-top: 8vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid mx-auto d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="mb-3 text-center mt-5" style="font-size: 30px;">
                <i class="fas fa-stethoscope"></i>
                <span>Online Maintenance Management System</span>
            </div>
            <p class="text-center" style="font-size: 20px;"> <i class="fas fa-user-secret text-danger"></i>
                <span>Admin Area (demo)</span>
            </p>
            <div class="container-fluid">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="shadow-lg p-4" method="POST">
                    <div class="form-group">
                        <i class="fas fa-user"></i><label for="aEmail" class="pl-2 font-weight-bold">Email</label><input
                            type="email" class="form-control" placeholder="Email" name="aEmail">
                        <small class="form-text">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key"></i><label for="aPassword"
                            class="pl-2 font-weight-bold">Password</label><input type="password" class="form-control"
                            placeholder="Password" name="aPassword">
                    </div>

                    <div> <input type="checkbox" name="check"> Remember me</div>

                    <input type="submit" class="btn btn-outline-danger mt-3 btn-block shadow-sm font-weight-bold"
                        name="login" value="Login">

                    <div class="text-danger mt-3">
                        <?php echo $loginError; ?>
                    </div>
                </form>
                <div class="text-center"><a class="btn btn-info mt-3 shadow-sm font-weight-bold"
                        href="../index.php">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
</body>

</html>