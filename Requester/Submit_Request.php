<?php
define('TITLE', 'Submit Request');

include ('includes/common.php');
include ('../db_connection.php');
session_start();

$warningMessage = ""; // Single warning message
$genid = ""; // Variable to store the generated ID
$msg = ""; // Declaration of $msg

if (!$_SESSION['is_login']) {
    header("Location: RequesterLogin.php");
    exit();
}

$rEmail = $_SESSION['user_email'];

// Fetch user's phone number and user ID from user_login table
$sql = "SELECT user_id, user_mobile FROM user_login WHERE user_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $rEmail);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$rPhone = $row['user_mobile'];
$user_id = $row['user_id']; // Retrieve the user_id

if (isset($_POST['submitrequest'])) {
    // Server-side validation and processing

    // Check if any field is empty
    if (empty($_POST['requestinfo']) || empty($_POST['requestdescription']) || empty($_POST['requestname']) || empty($_POST['requestdate']) || empty($_POST['requesteraadd1']) || empty($_POST['requesteraadd2']) || empty($_POST['requesterstate']) || empty($_POST['requesterCity']) || empty($_POST['requesterZip'])) {
        $warningMessage = "All fields are required";
    } else {
        $rinfo = $_POST['requestinfo'];
        $rdesc = $_POST['requestdescription'];
        $rname = $_POST['requestname'];
        $rdate = $_POST['requestdate'];
        $radd1 = $_POST['requesteraadd1'];
        $radd2 = $_POST['requesteraadd2'];
        $rstate = $_POST['requesterstate'];
        $rcity = $_POST['requesterCity'];
        $rzip = $_POST['requesterZip'];

        // Corrected SQL query using prepared statement
        $sql = "INSERT INTO userrequest_tb (user_id, request_info, request_desc, requester_name, requester_add1, requester_add2, requester_state, requester_city, requester_zip, requester_email, requester_mobile, request_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssssssss", $user_id, $rinfo, $rdesc, $rname, $radd1, $radd2, $rstate, $rcity, $rzip, $rEmail, $rPhone, $rdate);

        if ($stmt->execute()) {
            $genid = $stmt->insert_id;
            $msg = "Sign of successful submission";
            $_SESSION['myid'] = $genid;

            // Redirect to submitRequestSuccess.php after a delay
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'submitRequestSuccess.php';
                    }, 5000); // 5000 milliseconds = 5 seconds
                  </script>";
        } else {
            $msg = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!-- Main Content -->

<div class="col-md-9 col-lg-6">


    <!-- Form -->
    <form class="mx-3 shadow p-4" action="" method="POST">

        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"> <!-- Hidden input for user_id -->

        <div class="form-group">
            <label for="inputRequest">Add the problem</label>
            <input type="text" class="form-control" id="inputRequestinfo" placeholder="Request Info" name="requestinfo">
        </div>

        <!-- Add the rest of the form fields -->

        <div class="form-group">
            <label for="inputRequestDescription">Description</label>
            <textarea class="form-control" id="inputRequestinfoDescription" placeholder="Add more information"
                name="requestdescription"></textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="i.e Manish" name="requestname">
            </div>
            <div class="form-group col-md-6">
                <label for="inputDate">Date</label>
                <input type="date" class="form-control" id="inputdate" placeholder="Add date" name="requestdate">
            </div>
        </div>

        <div class="form-group">
            <label for="inputAddress">Address line 1</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="house no. 123" name="requesteraadd1">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Address line 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Railway colony"
                name="requesteraadd2">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <input type="text" class="form-control" id="inputstate" name="requesterstate">
            </div>
            <div class="form-group col-md-4">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" name="requesterCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip" name="requesterZip"
                    onkeypress="return isInputNumber(event)">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="requesteremail"
                    value="<?php echo $rEmail; ?>" readonly>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPhone">Phone Number</label>
                <input type="text" class="form-control" id="inputPhone" placeholder="Mobile Number" name="requestmobile"
                    value="<?php echo $rPhone; ?>" readonly>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="submitrequest">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
    <!-- End Form -->


</div>

<!-- End Main Content -->
<?php include ('includes/footer.php'); ?>