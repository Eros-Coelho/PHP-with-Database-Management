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


<html>
    <form action="register.php" method="POST">

        <h3>Please enter your personal details:</h3>
<label for="userID">Please enter your User ID:</label>
<input type="text" name="user-id"> </br>

 <label for="fName">Please enter your first name:</label>
<input type="text" name="fName"> </br>

<label for="lName">Please enter your last name:</label>
<input type="text" name="lName"> </br>

<label for="address">Please enter your address:</label>
<input type="text" name="address"> </br>

<label for="eir_code">Please enter your Eir Code:</label>
<input type="text" name="eir-code"> </br>

<label for="phone">Please enter your mobile phone:</label>
<input type="text" name="phone"> </br>

<label for="email">Please enter your email:</label>
<input type="text" name="email"> </br>

<h3>Please enter the appliance's details:</h3>
    <!-- labels and user inputs for variables -->
    <label for="appliance-id">Please enter your the appliance ID:</label>
    <input type="text" name="appliance-id"> </br>

    <!-- keeping selection of appliance type as options rather than input text -->
    <label for="appliance-type">Please choose an appliance type:</label>
<select id="appliance" name="appliance-type">
    <option value="" selected disabled>--Select an appliance--</option>
    <option value="fridge">Fridge</option>
    <option value="washing-machine">Washing Machine</option>
    <option value="oven">Oven</option>
    <option value="kettle">Kettle</option>
    </select></br>

<label for="brand">Please enter your the appliance's brand:</label>
<input type="text" name="brand"> </br>
<label for="model">Please enter the appliance's model:</label>
<input type="text" name="model"></br>
<label for="serial-number">Please enter the serial number:</label>
<input type="text" name="serial-number"></br>
<label for="purchase-date">Please enter the purchase date:</label>
<input type="text" name="purchase-date">(DD/MM/YYYY format)</br>
<label for="warranty-expiration">Please enter the Warranty Experiation Date:</label>
<input type="text" name="warranty-expiration">(DD/MM/YYYY format)</br>
<label for="appliance-cost">Please enter your the appliance cost:</label>
<input type="text" name="appliance-cost"> </br>

    <button type="submit">Add to Inventory</button>

    </form>
</html>