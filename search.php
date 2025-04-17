<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect("localhost", "root", "", "assignment2");
// connecting to the apache server and the databse "assignment2"

if (!$con) {
    echo "Error: Could not connect to Database";
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['serial-number'])) {

    $serial_number = $_GET['serial-number'];

    $querySearch = "SELECT * FROM Appliances WHERE serial_number = '$serial_number'";
    $resultSearch = mysqli_query($con, $querySearch);

    if ($resultSearch->num_rows > 0) {

        $appliance_data = $resultSearch->fetch_assoc();

        echo "<div class='search-result'>";
        echo "<h3>Appliance Details:</h3>";
        echo "Appliance ID: " . $appliance_data['applianceID'] . "<br>";
        echo "Brand: " . $appliance_data['brand'] . "<br>";
        echo "Model: " . $appliance_data['model'] . "<br>";
        echo "Serial Number: " . $appliance_data['serial_number'] . "<br>";
        echo "Purchase Date: " . $appliance_data['purchase_date'] . "<br>";
        echo "Warranty Expiration Date: " . $appliance_data['warranty_expiration'] . "<br>";
        echo "Cost: €" . $appliance_data['appliance_cost'] . "<br>";
        echo "Type: " . $appliance_data['appliance_type'] . "<br>";
        echo "Owner ID: " . $appliance_data['userID'] . "<br>";
        echo "</div>";
    } else {
        echo "Sorry, no appliance with that serial number was found";
    }
}

?>

<html>

<head>
    <title>Search for Appliance</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form action="search.php" method="GET">
        <h3>Please enter the serial number of the appliance you are looking for:</h3>

        <label for="serial-number">Serial Number:</label>
        <input type="text" name="serial-number" value="<?php echo isset($_GET['serial-number']) ? $_GET['serial-number'] : ''; ?>"></br>

        <button type="submit">Search</button></br>

        <a href="index.html">Return Home</a>
</body>

</html>