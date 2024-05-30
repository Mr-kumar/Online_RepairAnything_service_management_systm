<!-- Commom to all file -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <title>
        <?php echo TITLE ?>;
    </title>
</head>

<body>
    <!-- Top NAVBAR -->
    <nav class="navbar navbar-dark fixed-top bg-danger flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="user_profile.php">SERVICE</a>>
    </nav>
    <!-- Side bar -->

    <div class="container-fluid" style="margin-top:40px;">
        <div class="row">
            <nav class="col-sm-2 col-md-2 col-lg-2 bg-light text-white sidebar py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="user_profile.php">
                                <i class="fas fa-user"></i>Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Submit_Request.php">
                                <i class="fab fa-accessible-icon"></i>Submit Request
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Status.php">
                                <i class="fas fa-align-center"></i>Service Status
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Update_password.php">
                                <i class="fas fa-key"></i>Update Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">
                                <i class="fas fa-sign-out-alt"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>