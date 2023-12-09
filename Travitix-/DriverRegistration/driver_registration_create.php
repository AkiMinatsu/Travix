<?php
session_start();

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

    // Retrieve existing services from session or initialize an empty array
    $driver_services = isset($_SESSION['driver_services']) ? $_SESSION['driver_services'] : [];

    // Save the values to the list
    $driver_services[] = [
        'date_created' => date('Y-m-d H:i:s'),
        'uid' => $uid,
        'fullName' => $fullName,
        'city' => $city,
        'dateOfBirth' => $dateOfBirth,
        'licenseNo' => $licenseNo,
        'plateNo' => $plateNo,
        'status' => $status,
    ];

    // Handle image upload
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
    $_SESSION['driver_services'] = $driver_services;

    // Redirect to Driver_Registration.php
    header('Location: Driver_Registration.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Registration</title>
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
    <h1>Create Driver Account</h1>
    
    <form id="driverRegistrationForm" method="post" action="driver_registration_create.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="uid">UID:</label>
            <input type="text" id="uid" name="uid" required>
        </div>

        <div class="form-group">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>
        </div>
        
        <div class="form-group">
            <label for="dateOfBirth">Date of Birth:</label>
            <input type="date" id="dateOfBirth" name="dateOfBirth" required>
        </div>
        
        <div class="form-group">
            <label for="licenseNo">License No.:</label>
            <input type="text" id="licenseNo" name="licenseNo" required>
        </div>
        
        <div class="form-group">
            <label for="plateNo">Plate No.:</label>
            <input type="text" id="plateNo" name="plateNo" required>
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
            <button type="button" class="cancel" onclick="window.location.href='Driver_Registration.php'">Cancel</button>
        </div>
    </form>
</body>
</html>
