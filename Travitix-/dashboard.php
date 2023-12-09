<?php
include("config.php");
include("firebasetravitix.php");

if(!isset($_SESSION['user'])){
    header("location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        #sidebar {
            height: 100%;
            width: 240px;
            position: fixed;
            left: 0;
            bottom: -200; /* Lower the sidebar a bit */
            background-color: #808080; /* Blue background for TRAVITIX */
            color: #fff; /* White text */
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #sidebar ul li {
            padding: 10px; /* Increase padding for better readability */
            font-size: 18px; /* Increase font size */
        }

        #sidebar-title {
            text-align: center;
            padding: 10px 0;
            background-color: #808080; /* Black background for dashboard */
        }

        #sidebar-logo {
            text-align: center;
            padding: 10px 0;
        }

        #sidebar-logo img {
            width: 200px; /* Adjust the width of the logo as needed */
            height: 100px;
        }

        #content {
            margin-left: 240px;
            padding: 40px 20px; /* Add more padding to the top and bottom of the content */
            color: #fff; /* White text */
        }

        #content h5 {
            font-size: 24px; /* Increase font size for the welcome message */
            margin-bottom: 20px; /* Add some margin at the bottom */
            color: #000; /* Black text */
            text-align: center;
        }

        h1 {
            background-color: #808080;
            padding: 10px;
            margin: 0; 
            color: #fff; 
            width: 100%;
            box-sizing: border-box; 
        }

        #sidebar ul li img {
            width: 50px; 
            height: 30px; 
            margin-right: 10px;
        }

        /* Slick Carousel Styles */
        .carousel {
            width: 50%; /* Adjust the width of the carousel */
            margin: auto;
            margin-top: 20px;
        }

        .carousel img {
            width: 100%;
            height: auto;
            padding: 30px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="path/to/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="path/to/slick/slick-theme.css"/>
</head>
<body>
    <div id="sidebar">
        <div id="sidebar-logo">
            <img src="travitixlogo.png" alt="Logo">
        </div>
        <div id="sidebar-title">
            <h1>TRAVITIX</h1>
        </div>
        <ul>
            <li>
                <img src="Image/dashboard.png">
                <a href="dashboard.php" style="color: #fff;">Dashboard</a>
            </li>
            <li>
                <img src="Image/driver.png">
                <a href="DriverRegistration/Driver_Registration.php" style="color: #fff;">Driver Account</a>
            </li>
            <li>
                <img src="Image/mmda.png">
                <a href="MMDARegistration/MMDA_Registration.php" style="color: #fff;">MMDA Account</a>
            </li>
            <li>
                <img src="Image/report.png">
                <a href="ViolatorReports/Reports.php" style="color: #fff;">Report</a>
            </li>
            <li>
                <img src="Image/list.png">
                <a href="ViolationList/Violation_List.php" style="color: #fff;">Violation List</a>
            </li>
            <li>
                <img src="Image/logout.png">
                <a href="logout.php" style="color: #fff;">Log Out</a>
            </li>
        </ul>
    </div>

    <div id="content">
        <div class="relative flex h-[calc(100vh-20rem)] w-full max-w-[20rem] flex-col rounded-xl bg-white bg-clip-border p-4 text-gray-700 shadow-xl shadow-blue-gray-900/5">
            <!-- Welcome message -->
            <div class="p-4 mb-2">
                <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-black">
                    Welcome to Travitix
                </h5>
            </div>
            
            <!-- Carousel -->
            <div class="carousel">
                <div><img src="violationimage/image1.png" alt="Slide 1"></div>
                <div><img src="violationimage/image2.png" alt="Slide 2"></div>
                <div><img src="violationimage/image3.png" alt="Slide 3"></div>
                <div><img src="violationimage/image4.png" alt="Slide 4"></div>
                <div><img src="violationimage/image5.png" alt="Slide 5"></div>
                <div><img src="violationimage/image6.png" alt="Slide 6"></div>
                <div><img src="violationimage/image7.png" alt="Slide 7"></div>
                <div><img src="violationimage/image8.png" alt="Slide 8"></div>
                <div><img src="violationimage/image9.png" alt="Slide 9"></div>
                <div><img src="violationimage/image10.png" alt="Slide 10"></div>
                <!-- ...dagdag mo ang iba pang slides dito... -->
            </div>

            <nav class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-white">
                <!-- Sidebar menu items go here -->
            </nav>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="path/to/slick/slick.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.carousel').slick({
                autoplay: true,
                autoplaySpeed: 3000, // 3 seconds per slide
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        });
    </script>
</body>
</html>