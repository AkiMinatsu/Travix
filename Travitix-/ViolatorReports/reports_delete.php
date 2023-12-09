<?php
// No need to call session_start() if it's already active

include('../config.php');
include('../firebasetravitix.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the reports_services key exists and is an array
    if (isset($_SESSION['reports_services']) && is_array($_SESSION['reports_services'])) {
        // Check if the ID is within the valid range of indices in the session array
        if ($id >= 1 && $id <= count($_SESSION['reports_services'])) {
            // Get the report data to be deleted
            $reportToDelete = $_SESSION['reports_services'][$id - 1];

            // Remove the entry with the specified ID from the session
            array_splice($_SESSION['reports_services'], $id - 1, 1);

            // Instantiate the firebasetravitix class
            $firebase = new firebasetravitix($databaseURL);

            // Construct the path to the report in Firebase using a unique identifier (e.g., dateandtime)
            $path = 'Violators/' . $reportToDelete['dateandtime'] . '.json';

            // Delete the corresponding entry from Firebase
            $firebase->deletePath($path);

            // Redirect back to the violation list after deletion
            header('Location: Reports.php');
            exit;
        } else {
            // Handle invalid ID (out of range)
            echo "Invalid ID for deletion.";
            exit;
        }
    } else {
        // Handle missing or invalid session data
        echo "Invalid session data.";
        exit;
    }
} else {
    // Handle invalid request method or missing ID parameter
    echo "Invalid request.";
    exit;
}
?>
