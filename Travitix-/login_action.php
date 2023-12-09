<?php

include("config.php");
include(__DIR__ . "/firebasetravitix.php");

// Assuming you have user data, retrieve user details
$rdb = new firebasetravitix($databaseURL);
$retrieve = $rdb->retrieve("/admin", "", "", "");
$userData = json_decode($retrieve, true);

// Assuming you want to log in the first user found
if (!empty($userData)) {
    // Get the first user
    $firstUser = reset($userData);

    // Set session variable
    $_SESSION['user'] = $firstUser;

    // Redirect to dashboard
    echo "<script>alert('Successfully login'); window.location='dashboard.php';</script>";
} else {
    echo "No users found";
}
?>
