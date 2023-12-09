<?php
include('../config.php');
include('../firebasetravitix.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the report ID and status from the AJAX request
    $reportId = $_POST['id'];
    $status = $_POST['status'];

    // Instantiate the firebasetravitix class
    $firebase = new firebasetravitix($databaseURL);

    // Retrieve data from the "Violators" node
    $response = $firebase->retrieve('Violators');

    // Decode the JSON response
    $data = json_decode($response, true);

    // Log the received data for debugging
    file_put_contents('debug.log', 'Received POST data: ' . print_r($_POST, true), FILE_APPEND);
    file_put_contents('debug.log', 'Current data in Firebase: ' . print_r($data, true), FILE_APPEND);

    // Update the status in the local data
    $dataToUpdate = [
        'pendingorcomplete' => $status,
    ];

    // Save the updated data to the "Violators" node in Firebase using the appropriate method (e.g., update)
    $firebase->update('Violators', $reportId, $dataToUpdate);

    // Use JavaScript to reload the page after a short delay
    echo '<script>
            setTimeout(function() {
                window.location.href = "reports.php";
            }, 15000); // 1000 milliseconds = 1 second
          </script>';
} else {
    echo '<script>
            setTimeout(function() {
                window.location.href = "Reports.php";
            }, 15000); // 1000 milliseconds = 1 second
          </script>';
}
?>
