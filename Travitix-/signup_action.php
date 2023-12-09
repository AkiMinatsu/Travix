<?php
include("config.php");
include("firebasetravitix.php");

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if ($email == "") {
    echo "Email is required";
} elseif ($name == "") {
    echo "Name is required";
} elseif ($password == "") {
    echo "Password is required";
} else {
    $rdb = new firebasetravitix($databaseURL);

    // Generate a unique key for the new user
    $newKey = uniqid();

    // Use insert with the unique key
    $insert = $rdb->insert("/admin/{$newKey}", [
        "name" => $name,
        "email" => $email,
        "password" => $password
    ]);

    $result = json_decode($insert, true);

    if (isset($result['name'])) {
        echo "Signup success, please login";
        echo "<script>alert('Signup success, please login'); window.location='login.php';</script>";
    } else {
        echo "Signup failed";
    }
}
?>
