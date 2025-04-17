<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect("localhost", "root", "", "assignment2");
// connecting to the apache server and the databse "assignment2"

if (!$con) {
    echo "Error: Could not connect to Database";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id = $_POST['user-id'];
    $serial_number = $_POST['serial-number'];

    // Prepare and execute deletion from Appliances
    $stmt = $con->prepare("DELETE FROM Appliances WHERE serial_number = ?");
    $stmt->bind_param("s", $serial_number);
    $stmt->execute();

    // Prepare and execute deletion from User
    $stmtUser = $con->prepare("DELETE FROM User WHERE userID = ?");
    $stmtUser->bind_param("s", $user_id);
    $stmtUser->execute();

    // Check if any rows were deleted
    if ($stmt->affected_rows > 0 || $stmtUser->affected_rows > 0) {
        echo "Appliance Deleted Successfully along with User Details!";
    } else {
        echo "Error! No appliance or user found with that information.";
    }

    $stmt->close();
    $stmtUser->close();
}

?>

<html>

<head>
    <title>Delete Appliance Details</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <form action="delete.php" method="POST">
        <h3>Please enter the details of the appliance you wish to delete:</h3>
        <label for="user-id">User ID:</label>
        <input type="text" name="user-id" value="<?php echo isset($_POST['user-id']) ? $_POST['user-id'] : ''; ?>"> </br>
        <label for="serial-number">Serial Number:</label>
        <input type="text" name="serial-number" value="<?php echo isset($_POST['serial-number']) ? $_POST['serial-number'] : ''; ?>"></br>

        <button type="submit">Delete</button>

    </form>

    <a href="index.html">Return Home</a>
</body>

</html>