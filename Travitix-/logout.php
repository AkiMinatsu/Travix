<?php
include("config.php");
include("firebasetravitix.php");

if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
}

header("location: login.php");