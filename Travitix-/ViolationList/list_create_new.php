<?php
session_start();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from form submission
    $violationType = $_POST['violationType'];
    $description = $_POST['description'];
    $fineAmount = $_POST['fineAmount'];

    // Perform any necessary validation or sanitization

    // Retrieve existing services from session or initialize an empty array
    $services = isset($_SESSION['services']) ? $_SESSION['services'] : [];

    // Save the values to the list
    $services[] = [
        'date_created' => date('Y-m-d H:i:s'),
        'service' => $violationType,
        'description' => $description,
        'status' => $fineAmount,
    ];

    // Save the updated list to the session
    $_SESSION['services'] = $services;

    // Redirect to violation_list.php
    header('Location: Violation_List.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Violation</title>
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

        #violationForm {
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
    <h1>Create New Violation</h1>
    
    <form id="violationForm" method="post" action="list_create_new.php">
        <div class="form-group">
            <label for="violationType">Violation Code / Violation Type:</label>
            <input type="text" id="violationType" name="violationType" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="fineAmount">Fine Amount:</label>
            <select id="fineAmount" name="fineAmount" required>
                <?php
                $fineAmounts = [500, 1000, 1500, 2000, 2500, 3000, 3500, 4000, 4500, 5000, 5500, 6000, 6500, 7000, 7500, 8000, 8500, 9000, 9500, 10000, 10500, 11000, 11500, 12000, 12500, 13000, 13500, 14000, 14500, 15000, 15500, 16000, 16500, 17000, 17500, 18000, 18500, 19000, 19500, 20000, 20500, 21000, 21500, 22000, 22500, 23000, 23500, 24000, 24500, 25000, 25500, 26000, 26500, 27000, 27500, 28000, 28500, 29000, 29500, 30000];
                foreach ($fineAmounts as $amount) {
                    echo "<option value=\"$amount\">$amount</option>";
                }
                ?>
            </select>
        </div>
        
        <div style="text-align: center; margin-top: 20px;">
            <button type="submit">Save</button>
            <button type="button" class="cancel" onclick="window.location.href='Violation_List.php'">Cancel</button>
        </div>
    </form>
</body>
</html>
