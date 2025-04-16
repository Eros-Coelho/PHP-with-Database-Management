<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect("localhost", "root", "", "assignment2");
// connecting to the apache server and the databse "assignment2"

if (!$con){
    echo "Error: Could not connect to Database";
}

if ($_SERVER['REQUEST_METHOD'] == 'GET'){

    // variables for user table
    $user_id = $_GET['user-id'];
    $first_name = $_GET['fName'];
    $last_name = $_GET['lName'];
    $address = $_GET['address'];
    $eir_code = $_GET['eir-code'];
    $phone = $_GET['phone'];
    $email = $_GET['email'];

    // variables for appliance table
    $appliance_id = $_GET['appliance-id'];
    $brand = $_GET['brand'];
    $model = $_GET['model'];
    $serial_number = $_GET['serial-number'];
    $purchase_date = $_GET['purchase-date'];
    $warranty_expiration = $_GET['warranty-expiration'];
    $appliance_cost = $_GET['appliance-cost'];
    $appliance_type = $_GET['appliance-type'];   

    $querySearch = "SELECT * FROM Appliances WHERE serial_number = '$serial_number'";
    $resultSearch = mysqli_query($con, $querySearch);

    if ($resultSearch -> num_rows > 0){

        $appliance_data = $resultSearch -> fetch_assoc();
        echo "Appliance ID:".$appliance_data['appliance-id'];
        echo "Brand:".$appliance_data['brand'];
        echo "Model:".$appliance_data['model'];
        echo "Serial Number:".$appliance_data['serial-number'];
        echo "Purchase Date:".$appliance_data['purchase-date'];
        echo "Warranty Expiration Date:".$appliance_data['warranty-expiration'];
        echo "Cost: $".$appliance_data['appliance-cost'];
        echo "Type:".$appliance_data['appliance-type'];
        echo "Owner:".$appliance_data['user-id'];

    } else {
        echo "Sorry, no appliance with that serial number was found";
    }

}

?>

<html>
    <head>
        <title>Search for Appliance</title>
    </head>

    <body>
        <form action="search.php" method="GET">
            <h3>Please enter the serial number of the appliance you are looking for:</h3>

            <label for="serial-number">Serial Number:</label>
    <input type="text" name="serial-number" value="<?php echo isset($_GET['serial-number']) ? $_GET['serial-number'] : ''; ?>"></br>
        
    <a href="index.html">Return Home</a>
    </body>
</html>