<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect("localhost", "root", "", "assignment2");

if (!$con) {
    echo "Error: Could not connect to Database";
}

$applianceData = null;
$errors = [];
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['search'])) {
        $serial_number = (int)$_POST['serial-number'];

        $state = $con->prepare("SELECT * FROM Appliances WHERE serial_number = ?");
        $state->bind_param("i", $serial_number);
        $state->execute();
        $result = $state->get_result();

        if ($result->num_rows > 0) {
            $applianceData = $result->fetch_assoc();
        } else {
            $errors[] = "No appliance found with that serial number.";
        }

        $state->close();
    }

    if (isset($_POST['update'])) {
        $serial_number = (int)$_POST['serial-number'];
        $brand = $_POST['brand'] ?? '';
        $model = $_POST['model'] ?? '';
        $purchase_date = $_POST['purchase_date'] ?? '';
        $warranty_expiration = $_POST['warranty_expiration'] ?? '';
        $appliance_cost = $_POST['appliance_cost'] ?? '';
        $appliance_type = $_POST['appliance_type'] ?? '';

        // validating inputs
        if (!is_numeric($appliance_cost)) {
            $errors[] = "Cost must be a number.";
        }

        if (empty($brand) || empty($model) || empty($purchase_date) || empty($warranty_expiration) || empty($appliance_type)) {
            $errors[] = "All fields must be filled in.";
        }

        // if there are no errors, follow with the program
        if (empty($errors)) {
            $updateStmt = $con->prepare("UPDATE Appliances SET brand = ?, model = ?, purchase_date = ?, warranty_expiration = ?, appliance_cost = ?, appliance_type = ? WHERE serial_number = ?");
            $updateStmt->bind_param("ssssssi", $brand, $model, $purchase_date, $warranty_expiration, $appliance_cost, $appliance_type, $serial_number);
            $updateStmt->execute();

            // if columns were affected, tell the user the update was successful
            if ($updateStmt->affected_rows > 0) {
                $successMessage = "Appliance details have been updated successfully!";
            } else {
                $errors[] = "No changes made or appliance not found.";
            }

            $updateStmt->close();
        }

        // refill form with attempted values
        $applianceData = $_POST;
    }
}
?>

<html>

<head>
    <title>Update Appliance Details</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <h3>Please enter the serial number of the appliance you are looking for:</h3>

    <form action="update.php" method="POST">
        <label for="serial-number">Serial Number:</label>
        <input type="text" name="serial-number" value="<?php echo htmlspecialchars($_POST['serial-number'] ?? ''); ?>"><br>
        <button type="submit" name="search">Search</button><br>
    </form>

    <a href="index.html">Return Home</a>

    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <div style="color: green;">
            <p><?php echo $successMessage; ?></p>
        </div>
    <?php endif; ?>

    <div class="search-result">
        <?php if ($applianceData): ?>
            <h3>Appliance Found:</h3>
            <form action="update.php" method="POST">
                <input type="hidden" name="serial-number" value="<?php echo htmlspecialchars($applianceData['serial_number'] ?? $_POST['serial-number']); ?>">

                <label for="brand">Brand:</label>
                <input type="text" name="brand" value="<?php echo htmlspecialchars($applianceData['brand'] ?? ''); ?>"><br>

                <label for="model">Model:</label>
                <input type="text" name="model" value="<?php echo htmlspecialchars($applianceData['model'] ?? ''); ?>"><br>

                <label for="purchase_date">Purchase Date:</label>
                <input type="text" name="purchase_date" value="<?php echo htmlspecialchars($applianceData['purchase_date'] ?? ''); ?>" placeholder="YYYY-MM-DD"><br>

                <label for="warranty_expiration">Warranty Expiration:</label>
                <input type="text" name="warranty_expiration" value="<?php echo htmlspecialchars($applianceData['warranty_expiration'] ?? ''); ?>" placeholder="YYYY-MM-DD"><br>

                <label for="appliance_cost">Cost (€):</label>
                <input type="text" name="appliance_cost" value="<?php echo htmlspecialchars($applianceData['appliance_cost'] ?? ''); ?>"><br>

                <label for="appliance_type">Appliance Type:</label>
                <select name="appliance_type">
                    <option value="" disabled <?php echo empty($applianceData['appliance_type']) ? 'selected' : ''; ?>>--Select an appliance--</option>
                    <?php
                    $types = ['fridge', 'Microwave', 'oven', 'kettle'];
                    foreach ($types as $type) {
                        $selected = ($applianceData['appliance_type'] ?? '') === $type ? 'selected' : '';
                        echo "<option value=\"$type\" $selected>" . ucfirst($type) . "</option>";
                    }
                    ?>
                </select><br>

                <button type="submit" name="update">Update Appliance</button>
            </form>
        <?php endif; ?>
    </div>

</body>

</html>