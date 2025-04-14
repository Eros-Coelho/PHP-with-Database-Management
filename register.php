<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$con = mysqli_connect("localhost", "root", "", "assignment2");
// connecting to the apache server and the databse "assignment2"
if (!$con){
    echo "Error: Could not connect to Database";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // variables for user table
    $user_id = $_POST['user-id'];
    $first_name = $_POST['fName'];
    $last_name = $_POST['lName'];
    $address = $_POST['address'];
    $eir_code = $_POST['eir-code'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // variables for appliance table
    $appliance_id = $_POST['appliance-id'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $serial_number = $_POST['serial-number'];
    $purchase_date = $_POST['purchase-date'];
    $warranty_expiration = $_POST['warranty-expiration'];
    $appliance_cost = $_POST['appliance-cost'];
    $appliance_type = $_POST['appliance-type'];

    // creating two different variables with queries for both tables
    $queryUser = "INSERT INTO User (userID, first_name, last_name, address, eir_code, phone, email) VALUES ('$user_id', '$first_name', '$last_name', '$address', '$eir_code', '$phone', '$email')";
    $queryAppliance = "INSERT INTO Appliances (applianceID, brand, model, serial_number, purchase_date, warranty_expiration, appliance_cost, appliance_type, userID) VALUES ('$appliance_id', '$brand', '$model', '$serial_number', '$purchase_date', '$warranty_expiration', '$appliance_cost', '$appliance_type', '$user_id')";
    $resultUser = mysqli_query($con, $queryUser);
    $resultAppliance = mysqli_query($con, $queryAppliance);

    if ($resultUser && $resultAppliance){
        echo "Data inserted successfully";
    } else {
        echo "Error, please try again later";
    }

    // makes sure no fields are left blank. If so, quit the program
    if (empty($user_id) || empty($first_name) || empty($last_name) || empty($address) || empty($eir_code) || empty($phone) || empty($email) || 
    empty($appliance_id) || empty($brand) || empty($model) || empty($serial_number) || empty($purchase_date) || empty($warranty_expiration) || empty($appliance_cost) || empty($appliance_type)) {
    echo "All fields are required! Please fill in all the fields.";
    exit(); 
}

}

?>