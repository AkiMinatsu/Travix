<?php
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from form submission
    $officerName = $_POST['officerName'];
    $deputationNo = $_POST['deputationNo'];
    $mmdaCode = $_POST['mmdaCode'];
    $contactNumber = $_POST['contactNumber'];
    $userid = $_POST['userid']; // Changed from 'email' to 'userid'
    $password = $_POST['password'];
    $status = $_POST['status'];

    // Perform any necessary validation or sanitization

    // Retrieve existing services from session or initialize an empty array
    $MMDA_services = isset($_SESSION['MMDA_services']) ? $_SESSION['MMDA_services'] : [];

    // Save the values to the list
    $MMDA_services[] = [
        'date_created' => date('Y-m-d H:i:s'),
        'officerName' => $officerName,
        'deputationNo' => $deputationNo,
        'mmdaCode' => $mmdaCode,
        'contactNumber' => $contactNumber,
        'userid' => $userid,
        'password' => $password,
        'status' => $status,
    ];
    

    // Handle image upload
    $uid = $userid; // You can use userid as uid, change it accordingly
    $imagePath = "../images/" . $uid . ".jpg"; // Assuming you want to name the image with the UID and use jpg format

    // Create the upload directory if it doesn't exist
    $uploadDirectory = "../images/";
    if (!is_dir($uploadDirectory)) {
        // Attempt to create the directory
        if (!mkdir($uploadDirectory, 0755, true)) {
            echo "Error: Unable to create the image upload directory.";
            exit;
        }
    }

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error uploading image.";
    }

    // Save the updated list to the session
    $_SESSION['MMDA_services'] = $MMDA_services;

    // Redirect to Driver_Registration.php
    header('Location: MMDA_Registration.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MMDA Registration</title>
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
    <h1>Create MMDA Account</h1>
    
    <form id="driverRegistrationForm" method="post" action="MMDA_Registration_Create.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="officerName">Officer Name:</label>
            <input type="text" id="officerName" name="officerName" required>
        </div>

        <div class="form-group">
            <label for="deputationNo">Deputation No.:</label>
            <input type="text" id="deputationNo" name="deputationNo" required>
        </div>

        <div class="form-group">
            <label for="mmdaCode">MMDA Code:</label>
            <input type="text" id="mmdaCode" name="mmdaCode" required>
        </div>

        <div class="form-group">
            <label for="contactNumber">Contact Number:</label>
            <input type="text" id="contactNumber" name="contactNumber" required>
        </div>

        <div class="form-group">
            <label for="userid">Userid:</label>
            <input type="text" id="userid" name="userid" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit">Save</button>
            <button type="button" class="cancel" onclick="window.location.href='MMDA_Registration.php'">Cancel</button>
        </div>
    </form>
</body>
</html>
