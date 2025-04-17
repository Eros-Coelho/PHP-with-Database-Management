<?php
// prints all errors on screen
error_reporting(E_ALL);
ini_set('display_errors', 1);

// connects the php with the mysql database
$con = mysqli_connect("localhost", "root", "", "assignment2");

// if cannot find connection, kill the program
if (!$con) {
    die("Error: Could not connect to Database");
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_id = isset($_POST['user-id']) ? (int)$_POST['user-id'] : '';
    $first_name = isset($_POST['fName']) ? $_POST['fName'] : '';
    $last_name = isset($_POST['lName']) ? $_POST['lName'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $eir_code = isset($_POST['eir-code']) ? $_POST['eir-code'] : '';
    $phone = isset($_POST['phone']) ? (int)$_POST['phone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    $appliance_id = isset($_POST['appliance-id']) ? (int)$_POST['appliance-id'] : '';
    $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
    $model = isset($_POST['model']) ? $_POST['model'] : '';
    $serial_number = isset($_POST['serial-number']) ? (int)$_POST['serial-number'] : '';
    $purchase_date = isset($_POST['purchase-date']) ? $_POST['purchase-date'] : '';
    $warranty_expiration = isset($_POST['warranty-expiration']) ? $_POST['warranty-expiration'] : '';
    $appliance_cost = isset($_POST['appliance-cost']) ? (float)$_POST['appliance-cost'] : '';
    $appliance_type = isset($_POST['appliance-type']) ? $_POST['appliance-type'] : '';

    //  makes sure all fields are valid
    if (
        empty($user_id) || empty($first_name) || empty($last_name) || empty($address) || empty($eir_code) || empty($phone) || empty($email) ||
        empty($appliance_id) || empty($brand) || empty($model) || empty($serial_number) || empty($purchase_date) || empty($warranty_expiration) ||
        empty($appliance_cost) || empty($appliance_type)
    ) {
        $error = "All fields are required! Please fill in all the fields.";
        // makes sure the email input by the user is valid
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
        // if all fields are correct and not empty, only then will the program continue and insert the values into the tables
    } else {
        // insert into User table
        $stateUser = $con->prepare("INSERT INTO User (userID, first_name, last_name, address, eir_code, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stateUser->bind_param("issssis", $user_id, $first_name, $last_name, $address, $eir_code, $phone, $email);

        // insert into Appliances table
        $stateAppliance = $con->prepare("INSERT INTO Appliances (applianceID, brand, model, serial_number, purchase_date, warranty_expiration, appliance_cost, appliance_type, userID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stateAppliance->bind_param("ississdsi", $appliance_id, $brand, $model, $serial_number, $purchase_date, $warranty_expiration, $appliance_cost, $appliance_type, $user_id);

        // checks if queries were executed properly
        if ($stateUser->execute() && $stateAppliance->execute()) {
            $success = "Data inserted successfully!";
        } else {
            $error = "Error. Please try again.";
        }

        if (isset($stateUser)) $stateUser->close();
        if (isset($stateAppliance)) $stateAppliance->close();
    }

    $con->close();
}
?>

<html>

<head>
    <title>Register a New Appliance</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form action="add.php" method="POST">
        <h1>Register a New Appliance</h1>

        <!-- if there are errors, colour red, if not, colour green -->
        <?php
        if (!empty($error)) {
            echo "<p style='color: red;'>$error</p>";
        }
        if (!empty($success)) {
            echo "<p style='color: green;'>$success</p>";
        }
        ?>

        <h3>Please enter your personal details:</h3>

        <!-- html form and sanitising the inputs -->
        <!-- when the user leaves a field blank and comes back, whatever they typed before doesn't go away -->
        <label for="user-id">User ID:</label>
        <input type="text" name="user-id" value="<?php echo htmlspecialchars($_POST['user-id'] ?? ''); ?>"> </br>

        <label for="fName">First Name:</label>
        <input type="text" name="fName" value="<?php echo htmlspecialchars($_POST['fName'] ?? ''); ?>"> </br>

        <label for="lName">Last Name:</label>
        <input type="text" name="lName" value="<?php echo htmlspecialchars($_POST['lName'] ?? ''); ?>"> </br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>"> </br>

        <label for="eir-code">Eir Code:</label>
        <input type="text" name="eir-code" value="<?php echo htmlspecialchars($_POST['eir-code'] ?? ''); ?>"> </br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"> </br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"> </br>

        <h3>Please enter the appliance's details:</h3>

        <label for="appliance-id">Appliance ID:</label>
        <input type="text" name="appliance-id" value="<?php echo htmlspecialchars($_POST['appliance-id'] ?? ''); ?>"> </br>

        <label for="appliance-type">Appliance Type:</label>
        <select name="appliance-type">
            <option value="" disabled <?php echo empty($_POST['appliance-type']) ? 'selected' : ''; ?>>--Select an appliance--</option>
            <option value="fridge" <?php echo (($_POST['appliance-type'] ?? '') === 'Fridge') ? 'selected' : ''; ?>>Fridge</option>
            <option value="Microwave" <?php echo (($_POST['appliance-type'] ?? '') === 'Microwave') ? 'selected' : ''; ?>>Microwave</option>
            <option value="oven" <?php echo (($_POST['appliance-type'] ?? '') === 'Oven') ? 'selected' : ''; ?>>Oven</option>
            <option value="kettle" <?php echo (($_POST['appliance-type'] ?? '') === 'Kettle') ? 'selected' : ''; ?>>Kettle</option>
        </select> </br>

        <label for="brand">Brand:</label>
        <input type="text" name="brand" value="<?php echo htmlspecialchars($_POST['brand'] ?? ''); ?>"> </br>

        <label for="model">Model:</label>
        <input type="text" name="model" value="<?php echo htmlspecialchars($_POST['model'] ?? ''); ?>"> </br>

        <label for="serial-number">Serial Number:</label>
        <input type="text" name="serial-number" value="<?php echo htmlspecialchars($_POST['serial-number'] ?? ''); ?>"> </br>

        <label for="purchase-date">Purchase Date:</label>
        <input type="text" name="purchase-date" value="<?php echo htmlspecialchars($_POST['purchase-date'] ?? ''); ?>"> </br>

        <label for="warranty-expiration">Warranty Expiration:</label>
        <input type="text" name="warranty-expiration" value="<?php echo htmlspecialchars($_POST['warranty-expiration'] ?? ''); ?>"> </br>

        <label for="appliance-cost">Appliance Cost:</label>
        <input type="text" name="appliance-cost" value="<?php echo htmlspecialchars($_POST['appliance-cost'] ?? ''); ?>"> </br>

        <button type="submit">Add to Inventory</button>
    </form>

    <a href="index.html">Return Home</a>
</body>

</html>