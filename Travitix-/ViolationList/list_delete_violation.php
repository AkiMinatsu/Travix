<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the ID is within the valid range of indices in the session array
    if ($id >= 1 && $id <= count($_SESSION['services'])) {
        // Remove the entry with the specified ID
        array_splice($_SESSION['services'], $id - 1, 1);

        // Redirect back to the violation list after deletion
        header('Location: Violation_List.php');
        exit;
    } else {
        // Handle invalid ID (out of range)
        echo "Invalid ID for deletion.";
        exit;
    }
} else {
    // Handle invalid request method or missing ID parameter
    echo "Invalid request.";
    exit;
}
?>
