<?php
define('TITLE', 'Users');
define('PAGE', 'users');
include ('includes/header.php');
include ('../db_connection.php');
session_start();

// Check if admin is logged in
if (isset($_SESSION['is_adminlogin'])) {
    $adminEmail = $_SESSION['aEmail'];
} else {
    // Redirect to admin login page if not logged in
    echo "<script> location.href ='adminlogin.php'</script>";
    exit(); // Exit the script after redirection
}
?>
<div class="col-sm-9 col-md-10 mt-5 col-lg-9 text-center">
    <!--Table-->
    <p class=" bg-dark text-white p-2">List of Requesters</p>
    <?php
    $sql = "SELECT * FROM user_login";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display table if there are users
        echo '<table class="table">
                <thead>
                    <tr>
                        <th scope="col">Requester ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>';

        // Loop through each user
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <th scope="row">' . $row["user_id"] . '</th>
                    <td>' . $row["user_name"] . '</td>
                    <td>' . $row["user_email"] . '</td>
                    <td>
                        <form action="editreq.php" method="POST" class="d-inline">
                            <input type="hidden" name="id" value=' . $row["user_id"] . '>
                            <button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-pen"></i></button>
                        </form>  
                        <form action="" method="POST" class="d-inline">
                            <input type="hidden" name="id" value=' . $row["user_id"] . '>
                            <button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>';
        }

        echo '</tbody></table>';
    } else {
        // Display message if no users found
        echo "0 Result";
    }

    // Delete user if delete button is clicked
    if (isset($_POST['delete'])) {
        $deleteId = $_POST['id'];
        $sql = "DELETE FROM user_login WHERE user_id = $deleteId";
        if ($conn->query($sql) === TRUE) {
            // Refresh the page after deleting the record
            echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
        } else {
            echo "Unable to Delete Data";
        }
    }
    ?>
</div>
</div>
<div>
    <a class="btn btn-danger box" href="insertreq.php"><i class="fas fa-plus fa-2x"></i></a>
</div>
</div>
<?php include ('includes/footer.php') ?>