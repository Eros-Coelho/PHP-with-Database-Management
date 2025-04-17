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

    $queryDelete = "DELETE FROM Appliances WHERE serial_number = '$serial_number'";
    $queryDeleteUser = "DELETE FROM User WHERE UserID = '$user_id'";

    $resultDelete = mysqli_query($con, $queryDelete);
    $resultDeleteUser = mysqli_query($con, $queryDeleteUser);

    if ($resultDelete && $resultDeleteUser && mysqli_affected_rows($con) > 0) {
        echo "Appliance Deleted Successfully!";
    } else {
        echo "Error! No appliance found with that serial number";
    }
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