<?php
session_start();

// Check if 'MMDA_services' key exists in the session
$MMDA_services = isset($_SESSION['MMDA_services']) ? $_SESSION['MMDA_services'] : [];

// Retrieve the MMDA details based on the ID from the query string
$id = intval($_GET['id']);
$mmda = isset($MMDA_services[$id - 1]) ? $MMDA_services[$id - 1] : null;

// Check if MMDA details exist
if (!$mmda) {
    echo "MMDA not found.";
    exit;
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from form submission
    $officerName = $_POST['officerName'];
    $deputationNo = $_POST['deputationNo'];
    $mmdaCode = $_POST['mmdaCode'];
    $contactNumber = $_POST['contactNumber'];
    $userid = $_POST['userid'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    // Perform any necessary validation or sanitization

    // Update the values in the session array based on the $id
    if (isset($MMDA_services[$id - 1])) {
        $MMDA_services[$id - 1] = [
            'date_created' => date('Y-m-d H:i:s'),
            'officerName' => $officerName,
            'deputationNo' => $deputationNo,
            'mmdaCode' => $mmdaCode,
            'contactNumber' => $contactNumber,
            'userid' => $userid,
            'password' => $password,
            'status' => $status,
        ];

        // Save the updated list to the session
        $_SESSION['MMDA_services'] = $MMDA_services;

        // Redirect to the MMDA registration list after editing
        header('Location: MMDA_Registration.php');
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
    <title>Edit MMDA Information</title>
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

        #mmdaRegistrationForm {
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
    <h1>Edit MMDA Information</h1>
    
    <form id="mmdaRegistrationForm" method="post" action="mmda_edit.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="officerName">Officer Name:</label>
            <input type="text" id="officerName" name="officerName" value="<?php echo $mmda['officerName']; ?>" required>
        </div>

        <div class="form-group">
            <label for="deputationNo">Deputation No.:</label>
            <input type="text" id="deputationNo" name="deputationNo" value="<?php echo $mmda['deputationNo']; ?>" required>
        </div>

        <div class="form-group">
            <label for="mmdaCode">MMDA Code:</label>
            <input type="text" id="mmdaCode" name="mmdaCode" value="<?php echo $mmda['mmdaCode']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="contactNumber">Contact Number:</label>
            <input type="text" id="contactNumber" name="contactNumber" value="<?php echo $mmda['contactNumber']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="userid">Userid:</label>
            <input type="text" id="userid" name="userid" value="<?php echo $mmda['userid']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $mmda['password']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Active" <?php echo ($mmda['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                <option value="Inactive" <?php echo ($mmda['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>
        
        <div style="text-align: center; margin-top: 20px;">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit">Save</button>
            <button type="button" class="cancel" onclick="window.location.href='MMDA_Registration.php'">Cancel</button>
        </div>
    </form>
</body>
</html>
