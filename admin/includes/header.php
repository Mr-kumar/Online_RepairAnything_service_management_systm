<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo TITLE ?>
    </title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- Your Custom CSS -->
    <link rel="stylesheet" href="../css/custom.css">
</head>

<body>
    <nav class="navbar navbar-primary fixed-top bg-primary flex-md-nowrap p-2 shadow-none text-white">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-white" href="dashboard.php">SERVICE</a>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block bg-white sidebar sticky-sidebar d-print-none">
                <div class="position-sticky">
                    <div class="list-group list-group-flush mx-3 mt-4">
                        <!-- Your existing sidebar content -->
                        <a href="dashboard.php" class="list-group-item list-group-item-action py-2 ripple <?php if (PAGE == 'dashboard') {
                            echo 'active';
                        } ?>" aria-current="true">
                            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
                        </a>
                        <a href="workorder.php" class="list-group-item list-group-item-action py-2 ripple mt-2 <?php if (PAGE == 'workorder') {
                            echo 'active';
                        } ?>">
                            <i class="fas fa-tasks fa-fw me-3"></i><span>Work Order</span>
                        </a>
                        <a href="assets.php" class="list-group-item list-group-item-action py-2 ripple  mt-2 <?php if (PAGE == 'assets') {
                            echo 'active';
                        } ?>"><i class="fas fa-cogs fa-fw me-3"></i><span>Assets</span></a>
                        <a href="userRequest.php" class="list-group-item list-group-item-action py-2 ripple  mt-2 <?php if (PAGE == 'userRequest') {
                            echo 'active';
                        } ?>"><i class="fas fa-tasks fa-fw me-3"></i><span>Requests</span></a>
                        <a href="technician.php" class="list-group-item list-group-item-action py-2 ripple  mt-2 <?php if (PAGE == 'technician') {
                            echo 'active';
                        } ?>">
                            <i class="fas fa-wrench fa-fw me-3"></i><span>Technician</span>
                        </a>
                        <a href="orders.php" class="list-group-item list-group-item-action py-2 ripple  mt-2 <?php if (PAGE == 'orders') {
                            echo 'active';
                        } ?>"><i class="fas fa-file-invoice-dollar fa-fw me-3"></i><span>Orders</span></a>
                        <a href="sell_report.php" class="list-group-item list-group-item-action py-2 ripple  mt-2 <?php if (PAGE == 'sell_report') {
                            echo 'active';
                        } ?>"><i class="fas fa-chart-pie fa-fw me-3"></i><span>Sell Report</span></a>
                        <a href="work_report.php" class="list-group-item list-group-item-action py-2 ripple <?php if (PAGE == 'Work_report') {
                            echo 'active';
                        } ?>"><i class="fas fa-file-alt fa-fw me-3"></i><span>Work Report</span></a>
                        <a href="changepassword.php" class="list-group-item list-group-item-action py-2 ripple  mt-2 <?php if (PAGE == 'changepassword') {
                            echo 'active';
                        } ?>"><i class="fas fa-key fa-fw me-3"></i><span>Change Password</span></a>
                        <a href="users.php" class="list-group-item list-group-item-action py-2 ripple  mt-2 <?php if (PAGE == 'users') {
                            echo 'active';
                        } ?>"><i class="fas fa-users fa-fw me-3"></i><span>Users</span></a>

                        <a href="logout.php" class="list-group-item list-group-item-action py-2 ripple  mt-2 <?php if (PAGE == 'logout') {
                            echo 'active';
                        } ?>"><i class="fas fa-sign-out-alt fa-fw me-3"></i><span>Logout</span></a>
                    </div>
                </div>
            </nav>