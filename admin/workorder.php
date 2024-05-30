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
<!-- start second colomunn -->
<div class="col-sm-8 col-md-8 mt-5 mx-5">
    <?php
    $sql = "SELECT * FROM assignwork_tb";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope ="col">Req ID </th>';
        echo '<th scope ="col">Request info</th>';
        echo '<th scope ="col">Req Name </th>';
        echo '<th scope ="col">Req City</th>';
        echo '<th scope ="col">Req mob </th>';
        echo '<th scope ="col">Req technician </th>';
        echo '<th scope ="col">Assigned date</th>';

        echo '<th scope ="col"> Address </th>';
        echo '<th scope ="col"> Address 2 </th>';
        echo '<th scope ="col">Action</th>';


        echo '</tr>';

        echo '</thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['request_id'] . '</td>';
            echo '<td>' . $row['request_info'] . '</td>';
            echo '<td>' . $row['requester_name'] . '</td>';
            echo '<td>' . $row['requester_city'] . '</td>';
            echo '<td>' . $row['requester_mobile'] . '</td>';
            echo '<td>' . $row['assign_tech'] . '</td>';
            echo '<td>' . $row['request_date'] . '</td>';
            echo '<td>' . $row['requester_add1'] . '</td>';
            echo '<td>' . $row['requester_add2'] . '</td>';
            echo '<td>';
            echo '<form action="viewassignwork.php" method="POST" class="d-inline mr-2">';
            echo '<input type="hidden" name="id" value=' . $row['request_id'] . '>';
            echo '<button class="btn btn-primary" name="view" value="view" type="submit"><i class="far fa-eye"></i></button>';
            echo '</form>';

            echo '<form action="" method="POST" class="d-inline ml-1">';
            echo '<input type="hidden" name="id" value=' . $row['request_id'] . '>';
            echo '<button class="btn btn-secondary" name="delete" value="delete" type="submit"><i class="far fa-trash-alt"></i></button>';
            echo '</form>';
            echo '</td>';

            echo '</tr>';

        }
        echo '</tbody>';

        echo '</table>';



    } else {
        echo '0 Result';
    }
    if (isset($_POST['delete'])) {
        $sql = "DELETE FROM assignwork_tb WHERE request_id ={$_POST['id']}";
        if ($conn->query($sql) == TRUE) {
            echo '<meta http-equiv = "refresh" content = "0;url=?deleted" />';
        } else {
            echo "Unable to Delete Data";
        }
    }
    ?>
</div>
<?php include('includes/footer.php') ?>