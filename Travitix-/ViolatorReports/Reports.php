<?php
include('../config.php');
include('../firebasetravitix.php');

// Check if 'reports_services' key exists in the session
$reports_services = isset($_SESSION['reports_services']) ? $_SESSION['reports_services'] : [];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from form submission
    $uov = $_POST['uov'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $city = $_POST['city'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $licenseNo = $_POST['licenseNo'];
    $violationCode = $_POST['violationCode'];
    $violationType = $_POST['violationType'];
    $fineAmount = $_POST['fineAmount'];
    $status = $_POST['status'];
    $violationCodeI = $_POST['violationCodeI'];
    $violationCodeII = $_POST['violationCodeII'];
    $violationTypeI = $_POST['violationTypeI'];
    $violationTypeII = $_POST['violationTypeII'];

    // Perform any necessary validation or sanitization

    // Save the values to the database or your list
    $reports_services[] = [
        'dateandtime' => date('Y-m-d H:i:s'),
        'uov' => $uov,
        'lastName' => $lastName,
        'firstName' => $firstName,
        'middleName' => $middleName,
        'city' => $city,
        'dateOfBirth' => $dateOfBirth,
        'license_no' => $licenseNo,
        'violationCode' => $violationCode,
        'violationType' => $violationType,
        'fineAmount' => $fineAmount,
        'status' => $status,
        'violationcodeI' => $violationCodeI,
        'violationcodeII' => $violationCodeII,
        'violationTypeI' => $violationTypeI,
        'violationTypeII' => $violationTypeII,

    ];

    // Save the updated list to the session
    $_SESSION['reports_services'] = $reports_services;

    // Instantiate the firebasetravitix class
    $firebase = new firebasetravitix($databaseURL);

    // Save the new data to the "Violators" node in Firebase
    $firebase->insert('Violators', end($reports_services));

    // Redirect to the same page to prevent form resubmission
    header('Location: Report.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
        #search-container {margin-bottom: 20px;text-align: left;}

        td, th {white-space: nowrap; overflow: hidden; text-overflow: ellipsis;}
    </style>

    <script>
        $(document).ready(function () {
            // Add an event listener for the change event on the status dropdown
            $('select[name="status"]').change(function () {
                // Get the selected value
                var selectedStatus = $(this).val();

    

                // Get the corresponding report ID
                var reportId = $(this).closest('tr').find('td:first').text();

                // If the selected status is "Complete," show a confirmation dialog
                if (selectedStatus === 'Paid') {
                    var confirmSave = confirm("Are you sure you want to save this as Paid?");
                    if (!confirmSave) {
                        // If the user cancels, revert the dropdown to the previous value
                        $(this).val('pending');
                        return;
                    }
                }

                // Make an AJAX request to update the status in Firebase
                $.ajax({
                    type: 'POST',
                    url: 'update_status.php',
                    data: {
                        id: reportId,
                        status: selectedStatus
                    },
                    success: function (response) {
                        // Handle success if needed
                        console.log(response);

                        // Fetch the latest data from Firebase and update the table
                        fetchAndUpdateData();
                    },
                    error: function (error) {
                        // Handle error if needed
                        console.error(error);
                    }
                });
            });

            // Function to fetch the latest data from Firebase and update the table
            function fetchAndUpdateData() {
                $.ajax({
                    type: 'GET',
                    url: 'update_status.php', // Create a new PHP file for fetching data
                    success: function (data) {
                        // Update the table with the latest data
                        $('tbody').html(data);
                    },
                    error: function (error) {
                        // Handle error if needed
                        console.error(error);
                    }
                });
            }
        });

        $(document).ready(function () {
            // ... (Iba pang JavaScript code)
            // Search functionality
            $('#table-search').on('keyup', function () {
                var searchText = $(this).val().toLowerCase();
                // Iterate through each row in the table
            $('tbody tr').each(function () {
                var rowData = $(this).text().toLowerCase();
            // Show or hide the row based on the search text
            $(this).toggle(rowData.includes(searchText));
        });
    });
});
    </script>
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
                <a href="../DriverRegistration/Driver_Registration.php" style="color: #fff;">Driver Account</a>
            </li>
            <li>
                <img src="../Image/mmda.png">
                <a href="../MMDARegistration/MMDA_Registration.php" style="color: #fff;">MMDA Account</a>
            </li>
            <li>
                <img src="../Image/report.png">
                <a href="Reports.php" style="color: #fff;">Report</a>
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
                    Reports
                </h5>
            </div>
            <nav class="flex min-w-[240px] flex-col gap-1 p-2 font-sans text-base font-normal text-white">
                <!-- Sidebar menu items go here -->
            </nav>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">
                
                <div class="card-tools">
                    
                </div>
            </div>
            <div class="card-body">
                <div class="container-fluid">

                <div id="search-container">
                    <input type="text" id="table-search" placeholder="Search...">
                </div>
                    <table class="table table-bordered table-stripped">
                        <colgroup>
                            <!-- ... (your existing colgroup) ... -->
                            <col width="50">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date and Time</th>
                                <th>UOV</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>City</th>
                                <th>Date of Birth</th>
                                <th>License no.</th>
                                <th>Violation Code</th>
                                <th>Violation Type</th>
                                <th>Fine Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                // Instantiate the firebasetravitix class
                                $firebase = new firebasetravitix($databaseURL);

                                // Retrieve data from the "Violators" node
                                $response = $firebase->retrieve('Violators');

                                // Decode the JSON response
                                $data = json_decode($response, true);

                                // Check if there is data
                                if ($data) {
                                    // Iterate through each record
                                    foreach ($data as $key => $row) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $key; ?></td>
                                            <td><?php echo date('Y/m/d H:i:s', strtotime($row['dateandtime'])); ?></td>
                                            <td><?php echo isset($row['uovrno']) ? $row['uovrno'] : ''; ?></td>
                                            <td><?php echo $row['lastName']; ?></td>
                                            <td><?php echo $row['firstName']; ?></td>
                                            <td><?php echo $row['middlename']; ?></td>
                                            <td><?php echo $row['city']; ?></td>
                                            <td><?php echo $row['dateofbirth']; ?></td>
                                            <td><?php echo $row['licenseno']; ?></td>
                                            <td><?php echo $row['violationcode'] . ', ' . $row['violationcodeI'] . ', ' . $row['violationcodeII']; ?></td>
                                            <td><?php echo $row['violationtype'] . ', ' . $row['violationtypeI'] . ', ' . $row['violationtypeII']; ?></td>
                                            <td><?php echo $row['fineamount']; ?></td>
                                        
                                            <td>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="pending" <?php echo $row['pendingorcomplete'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="Paid" <?php echo $row['pendingorcomplete'] === 'Paid' ? 'selected' : ''; ?>>Paid</option>
                                                </select>
                                            </td>
                                            <td align="center">
                                                <a href="reports_delete.php?id=<?php echo $key; ?>" class="btn btn-flat btn-default btn-sm delete_data" data-id="<?php echo $key; ?>">
                                                    <span class="fa fa-trash text-danger"></span> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    // No data message or action
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            // ... (Previous JavaScript code)
        });
    </script>
</body>
</html>
