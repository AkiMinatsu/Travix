<?php
session_start();

// Check if 'services' key exists in the session
$driver_services = isset($_SESSION['driver_services']) ? $_SESSION['driver_services'] : [];

// Retrieve the driver details based on the ID from the query string
$id = intval($_GET['id']);
$driver = isset($driver_services[$id - 1]) ? $driver_services[$id - 1] : null;

// Check if driver details exist
if (!$driver) {
    echo "Driver not found.";
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from form submission
    $uid = $_POST['uid'];
    $fullName = $_POST['fullName'];
    $city = $_POST['city'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $licenseNo = $_POST['licenseNo'];
    $plateNo = $_POST['plateNo'];
    $status = $_POST['status'];

    // Perform any necessary validation or sanitization

    // Update the values in the session array based on the $id
    if (isset($driver_services[$id - 1])) {
        $driver_services[$id - 1] = [
            'date_created' => date('Y-m-d H:i:s'),
            'uid' => $uid,
            'fullName' => $fullName,
            'city' => $city,
            'dateOfBirth' => $dateOfBirth,
            'licenseNo' => $licenseNo,
            'plateNo' => $plateNo,
            'status' => $status,
        ];

        // Save the updated list to the session
        $_SESSION['driver_services'] = $driver_services;

        // Redirect to the violation list after editing
        header('Location: Driver_Registration.php');
        exit;
    }
}

// Display the form for editing
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Driver Information</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        #driverRegistrationForm {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button.cancel {
            background-color: #ccc;
            margin-right: 10px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Edit Driver Information</h1>
    
    <form id="driverRegistrationForm" method="post" action="driver_edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="uid">UID:</label>
            <input type="text" id="uid" name="uid" value="<?php echo $driver['uid']; ?>" required>
        </div>

        <div class="form-group">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" value="<?php echo $driver['fullName']; ?>" required>
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="<?php echo $driver['city']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="dateOfBirth">Date of Birth:</label>
            <input type="date" id="dateOfBirth" name="dateOfBirth" value="<?php echo $driver['dateOfBirth']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="licenseNo">License No.:</label>
            <input type="text" id="licenseNo" name="licenseNo" value="<?php echo $driver['licenseNo']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="plateNo">Plate No.:</label>
            <input type="text" id="plateNo" name="plateNo" value="<?php echo $driver['plateNo']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Active" <?php echo ($driver['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                <option value="Inactive" <?php echo ($driver['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>
        
        <div style="text-align: center; margin-top: 20px;">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">Save</button>
            <button type="button" class="cancel" onclick="window.location.href='Driver_Registration.php'">Cancel</button>
        </div>
    </form>
</body>
</html>
