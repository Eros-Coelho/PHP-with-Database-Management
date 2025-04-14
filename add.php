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
    <head>
        <h1>Register a New Appliance</h1>
    </head>

    <body>
<form action="add.php" method="POST">

<h3>Please enter your personal details:</h3>

    <!-- User details -->
    <label for="user-id">User ID:</label>
    <input type="text" name="user-id" value="<?php echo isset($_POST['user-id']) ? $_POST['user-id'] : ''; ?>"> </br>

    <label for="fName">First Name:</label>
    <input type="text" name="fName" value="<?php echo isset($_POST['fName']) ? $_POST['fName'] : ''; ?>"> </br>

    <label for="lName">Last Name:</label>
    <input type="text" name="lName" value="<?php echo isset($_POST['lName']) ? $_POST['lName'] : ''; ?>"> </br>

    <label for="address">Address:</label>
    <input type="text" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>"> </br>

    <label for="eir-code">Eir Code:</label>
    <input type="text" name="eir-code" value="<?php echo isset($_POST['eir-code']) ? $_POST['eir-code'] : ''; ?>"> </br>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>"> </br>

    <label for="email">Email:</label>
    <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"> </br>

    <!-- Appliance details -->
     <h3>Please enter the appliance's details:</h3>
    <label for="appliance-id">Appliance ID:</label>
    <input type="text" name="appliance-id" value="<?php echo isset($_POST['appliance-id']) ? $_POST['appliance-id'] : ''; ?>"> </br>

    <label for="appliance-type">Appliance Type:</label>
    <select name="appliance-type">
        <option value="" selected disabled>--Select an appliance--</option>
        <option value="fridge" <?php echo isset($_POST['appliance-type']) && $_POST['appliance-type'] == 'fridge' ? 'selected' : ''; ?>>Fridge</option>
        <option value="washing-machine" <?php echo isset($_POST['appliance-type']) && $_POST['appliance-type'] == 'washing-machine' ? 'selected' : ''; ?>>Washing Machine</option>
        <option value="oven" <?php echo isset($_POST['appliance-type']) && $_POST['appliance-type'] == 'oven' ? 'selected' : ''; ?>>Oven</option>
        <option value="kettle" <?php echo isset($_POST['appliance-type']) && $_POST['appliance-type'] == 'kettle' ? 'selected' : ''; ?>>Kettle</option>
    </select></br>

    <label for="brand">Brand:</label>
    <input type="text" name="brand" value="<?php echo isset($_POST['brand']) ? $_POST['brand'] : ''; ?>"> </br>

    <label for="model">Model:</label>
    <input type="text" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : ''; ?>"></br>

    <label for="serial-number">Serial Number:</label>
    <input type="text" name="serial-number" value="<?php echo isset($_POST['serial-number']) ? $_POST['serial-number'] : ''; ?>"></br>

    <label for="purchase-date">Purchase Date:</label>
    <input type="text" name="purchase-date" value="<?php echo isset($_POST['purchase-date']) ? $_POST['purchase-date'] : ''; ?>"></br>

    <label for="warranty-expiration">Warranty Expiration:</label>
    <input type="text" name="warranty-expiration" value="<?php echo isset($_POST['warranty-expiration']) ? $_POST['warranty-expiration'] : ''; ?>"></br>

    <label for="appliance-cost">Appliance Cost:</label>
    <input type="text" name="appliance-cost" value="<?php echo isset($_POST['appliance-cost']) ? $_POST['appliance-cost'] : ''; ?>"> </br>

    <button type="submit">Add to Inventory</button>

</form>
</body>
</html>