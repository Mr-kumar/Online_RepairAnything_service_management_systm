<?php
define('TITLE', 'WorkOrder');
define('PAGE', 'workorder');


include('includes/header.php');
include('../db_connection.php');
session_start();
if (isset($_SESSION['is_adminlogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href ='adminlogin.php'</script>";
}
?>
<!-- start of the second columnn -->
<div class="col-sm-6 mt-5 mx-3">
    <h3 class="text-center">Assign work Details</h3>
    <?php
    if (isset($_POST['id'])) {
        $requestId = $_POST['id'];
        $sql = "SELECT * FROM assignwork_tb WHERE request_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $requestId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        ?>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Request ID</td>
                <td>
                    <?php echo $row['request_id']; ?>
                </td>
            </tr>
            <tr>
                <td>Request Info</td>
                <td>
                    <?php echo $row['request_info']; ?>
                </td>
            </tr>
            <tr>
                <td>Request Description</td>
                <td>
                    <?php echo $row['request_desc']; ?>
                </td>
            </tr>
            <tr>
                <td>Request Name</td>
                <td>
                    <?php echo $row['requester_name']; ?>
                </td>
            </tr>
            <tr>
                <td>Address Line 1</td>
                <td>
                    <?php echo $row['requester_add1']; ?>
                </td>
            </tr>
            <tr>
                <td>Address Line 2</td>
                <td>
                    <?php echo $row['requester_add2']; ?>
                </td>
            </tr>
            <tr>
                <td>City</td>
                <td>
                    <?php echo $row['requester_city']; ?>
                </td>
            </tr>
            <tr>
                <td>Address Line 2</td>
                <td>
                    <?php echo $row['requester_state']; ?>
                </td>
            </tr>
            <tr>
                <td>Zip Address </td>
                <td>
                    <?php echo $row['requester_zip']; ?>
                </td>
            </tr>
            <tr>
                <td>Requet Date</td>
                <td>
                    <?php echo $row['request_date']; ?>
                </td>
            </tr>
            <tr>
                <td>user Email</td>
                <td>
                    <?php echo $row['requester_email']; ?>
                </td>
            </tr>
            <tr>
                <td>User Mobile</td>
                <td>
                    <?php echo $row['requester_mobile']; ?>
                </td>
            </tr>
            <tr>
                <td>Technician Name</td>
                <td>
                    <?php echo $row['assign_tech']; ?>
                </td>
            </tr>
            <tr>
                <td>Customer Sign</td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Technician Sign</td>
                <td>
                </td>
            </tr>

            <!-- Add more rows as needed -->
        </tbody>
    </table>
    <div class="text-center">
        <form action="" class="mb-3 d-print-none d-inline">
            <input type="submit" class="btn btn-danger" value="print" onclick="window.print()">
        </form>
        <form action="workorder.php" class="mb-3 d-print-none d-inline">
            <input type="submit" class="btn btn-secondary" value="Close">
        </form>

    </div>
    <?php } ?>

</div>
<!-- End of the second columnn -->

<?php include('includes/footer.php') ?>