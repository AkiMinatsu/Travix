<?php
session_start();

// Check if 'services' key exists in the session
$driver_services = isset($_SESSION['driver_services']) ? $_SESSION['driver_services'] : [];

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

    // Save the values to the database or your list
    // Example using a list:
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

    // Save the updated list to the session
    $_SESSION['driver_services'] = $driver_services;

    // Redirect to the same page to prevent form resubmission
    header('Location: Driver_Registration.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Account</title>
    <style>
        body { margin: 0; font-family: 'Arial', sans-serif; }
        #sidebar { height: 100%; width: 240px; position: fixed; left: 0; bottom: -200; background-color: #808080; color: #fff; padding-top: 20px; display: flex; flex-direction: column; align-items: center; }
        #sidebar ul { list-style-type: none; padding: 0; margin: 0; }
        #sidebar ul li { padding: 10px; font-size: 18px; }
        #sidebar-title { text-align: center; padding: 10px 0; background-color: #808080; }
        #sidebar-logo { text-align: center; padding: 10px 0; }
        #sidebar-logo img { width: 200px; height: 100px; }
        #content { margin-left: 240px; padding: 40px 20px; color: #000; }
        #content h5 { font-size: 24px; margin-bottom: 20px; color: #000; text-align: center; }
        h1 { background-color: #808080; padding: 10px; margin: 0; color: #fff; width: 100%; box-sizing: border-box; }
        #sidebar ul li img { width: 50px; height: 30px; margin-right: 10px; }

        /* Table Styles */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; color: #000; }
        th { background-color: #808080; color: #fff; }
        tr:hover { background-color: #f5f5f5; }
    </style>
</head>
<body>
    <div id="sidebar">
        <div id="sidebar-logo">
            <img src="../Image/travitixlogo.png" alt="Logo">
        </div>
        <div id="sidebar-title">
            <h1>TRAVITIX</h1>
        </div>
        <ul>
            <li>
                <img src="../Image/dashboard.png">
                <a href="../dashboard.php" style="color: #fff;">Dashboard</a>
            </li>
            <li>
                <img src="../Image/driver.png">
                <a href="Driver_Registration.php" style="color: #fff;">Driver Account</a>
            </li>
            <li>
                <img src="../Image/mmda.png">
                <a href="../MMDARegistration/MMDA_Registration.php" style="color: #fff;">MMDA Account</a>
            </li>
            <li>
                <img src="../Image/report.png">
                <a href="../ViolatorReports/Reports.php" style="color: #fff;">Report</a>
            </li>
            <li>
                <img src="../Image/list.png">
                <a href="../ViolationList/Violation_List.php" style="color: #fff;">Violation List</a>
            </li>
            <li>
                <img src="../Image/logout.png">
                <a href="../logout.php" style="color: #fff;">Log Out</a>
            </li>
        </ul>
    </div>

    <div id="content">
        <div class="relative flex h-[calc(100vh-20rem)] w-full max-w-[20rem] flex-col rounded-xl bg-white bg-clip-border p-4 text-gray-700 shadow-xl shadow-blue-gray-900/5">
            <div class="p-4 mb-2">
                <h5 class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-black">
                    Driver Registration
                </h5>
            </div>
            <nav class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-white">
                <!-- Sidebar menu items go here -->
            </nav>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Drivers Account</h3>
                <div class="card-tools">
                    <a href="driver_registration_create.php" class="btn btn-flat btn-primary">
                        <span class="fas fa-plus"></span> Driver Registration
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <table class="table table-bordered table-stripped">
                        <colgroup>
                            <!-- ... (your existing colgroup) ... -->
                            <col width="50">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date Created</th>
                                <th>UID</th>
                                <th>Full Name</th>
                                <th>City</th>
                                <th>Date of Birth</th>
                                <th>License no.</th>
                                <th>Plate no.</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
    $i = 1;
    foreach ($driver_services as $row):
    ?>
    <tr>
        <td class="text-center"><?php echo $i; ?></td>
        <td><?php echo $row['date_created']; ?></td>
        <td><?php echo $row['uid']; ?></td>
        <td><?php echo $row['fullName']; ?></td>
        <td><?php echo $row['city']; ?></td>
        <td><?php echo $row['dateOfBirth']; ?></td>
        <td><?php echo $row['licenseNo']; ?></td>
        <td><?php echo $row['plateNo']; ?></td>
        <td class="text-center">
            <?php echo "<span class='badge badge-success'>" . $row['status'] . "</span>"; ?>
        </td>
        <td>
            <?php 
                // Assuming your images are stored in a folder named "images"
                // You can change the path accordingly based on your actual structure
                $imagePath = "../images/" . $row['uid'] . ".jpg";
                echo '<img src="' . $imagePath . '" alt="Image" width="50" height="30">';
            ?>
        </td>
        <td align="center">
            <a href="driver_edit.php?id=<?php echo $i; ?>" class="btn btn-flat btn-default btn-sm">
                <span class="fa fa-edit text-primary"></span> Edit
            </a>
            <a href="driver_delete.php?id=<?php echo $i; ?>" class="btn btn-flat btn-default btn-sm delete_data" data-id="<?php echo $i; ?>">
                <span class="fa fa-trash text-danger"></span> Delete
            </a>
        </td>
    </tr> 
    <?php 
    $i++; 
    endforeach; 
    ?>
</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>