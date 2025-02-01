<?php include('header.php'); ?>
<?php
include_once('controller/connect.php');

// Initialize the database connection
$dbs = new database();
$db = $dbs->connection();

// Pagination settings
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch employees data
$sql = mysqli_query($db, "SELECT * FROM employees_data WHERE RoleId != 1");

// Fetch login/logout data with pagination
$sql_paginated = mysqli_query($db, "SELECT * FROM login_data ORDER BY LoginTime DESC LIMIT $start, $limit");
$total_results = mysqli_query($db, "SELECT COUNT(*) AS count FROM login_data");
$total_rows = mysqli_fetch_assoc($total_results)['count'];
$total_pages = ceil($total_rows / $limit);

if (isset($_POST['login'])) {
    $employeeId = mysqli_real_escape_string($db, $_POST['employeeId']);
    $loginTime = date("Y-m-d H:i:s");

    // Insert login time into the table, setting LogoutTime to NULL initially
    mysqli_query($db, "INSERT INTO login_data (EmployeeId, LoginTime, LogoutTime) VALUES ('$employeeId', '$loginTime', NULL)");

    echo "<script>alert('Login time recorded successfully!');</script>";
    echo "<script>window.location='modifiedlogout.php';</script>";
}

if (isset($_POST['logout'])) {
    $employeeId = mysqli_real_escape_string($db, $_POST['employeeId']);
    $logoutTime = date("Y-m-d H:i:s");

    // Find the most recent login record for the employee where LogoutTime is still NULL
    $logindate = mysqli_query($db, "SELECT * FROM login_data WHERE EmployeeId='$employeeId' AND LogoutTime IS NULL ORDER BY LoginTime DESC LIMIT 1");
    $logindateselect = mysqli_fetch_assoc($logindate);

    if ($logindateselect) {
        $loginTime = $logindateselect['LoginTime'];
        $loginTimestamp = strtotime($loginTime);
        $logoutTimestamp = strtotime($logoutTime);
        
        // Calculate time worked in seconds
        $timeWorkedInSeconds = $logoutTimestamp - $loginTimestamp;

        // Convert seconds to hours and minutes
        $hours = floor($timeWorkedInSeconds / 3600);
        $minutes = floor(($timeWorkedInSeconds % 3600) / 60);

        // Format the time worked for display
        $totalTimeWorked = '';
        if ($hours > 0) {
            $totalTimeWorked .= $hours . ' hour(s) ';
        }
        if ($minutes > 0) {
            $totalTimeWorked .= $minutes . ' minute(s)';
        }

        // Update the logout time and total hours worked
        $updateQuery = "UPDATE login_data SET LogoutTime='$logoutTime', TotalHours='$totalTimeWorked' WHERE EmployeeId='$employeeId' AND LoginTime='$loginTime'";
        $updateResult = mysqli_query($db, $updateQuery);

        if ($updateResult) {
            // Display total time worked
            echo "<script>alert('Logout time updated successfully! Total Time Worked: $totalTimeWorked');</script>";
        } else {
            echo "<script>alert('Error updating record: " . mysqli_error($db) . "');</script>";
        }

        echo "<script>window.location='modifiedlogout.php';</script>";
    } else {
        echo "<script>alert('No login record found for the employee.');</script>";
    }
}
?>

<head>
    <style>
        .container h2 {
            color: DodgerBlue;
            text-align: center;
            font-weight: 500;
            margin-bottom: 10px;
            font-size: 27px;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            position: relative;
            padding-bottom: 10px;
        }
        .table-container {
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background-color: #007bff;
            color: white;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            border-bottom: 2px solid #ddd;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #ddd;
        }
        .pagination {
            text-align: center;
            margin: 20px 0;
        }
        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            color: #007bff;
            padding: 8px 12px;
            border: 1px solid #007bff;
            border-radius: 4px;
        }
        .pagination a.active {
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: 1px solid #007bff;
        }
        .pagination a:hover {
            text-decoration: underline;
            background-color: #0056b3;
            color: #fff;
        }
        .scrollable-container {
            max-height: 500px;
            overflow-y: auto;
            padding: 10px;
            background: #fff;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <ol class="breadcrumb" style="margin: 10px 0;">
        <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i> Employee <i class="fa fa-angle-right"></i> Login/Logout Time</li>
    </ol>
    <div class="scrollable-container">
    <form method="POST">
        <div class="container" style="margin: 10px auto; padding: 20px; background: white; border-radius: 8px;">
            <h2 class="form-title"><b>Record Employee Login/Logout Time</b></h2>
            <hr>

            <!-- Employee ID selection -->
            <div class="row form-group">
                <label for="employeeId" class="col-md-2 control-label">Employee ID</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        <select name="employeeId" id="employeeId" class="form-control" style="width: 100%;" required>
                            <option value="">-- Select Employee ID --</option>
                            <?php while ($row = mysqli_fetch_assoc($sql)) { ?>
                                <option value="<?php echo $row['EmployeeId']; ?>"><?php echo $row['EmployeeId'] . " - " . $row['FirstName'] . " " . $row['LastName']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="row form-group">
                <div class="col-md-offset-2 col-md-8">
                    <button type="submit" name="login" class="btn btn-success">Login</button>
                    <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </div>
            </div>
        </div>
    </form>
  
    <!-- Table to display login/logout records -->
    <div class="table-container">
        <h2 class="form-title"><b>Login/Logout Records</b></h2>
        <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="color: white; background-color:#0056b3;  text-align: center;">Employee ID</th>
                    <th style="color: white; background-color:#0056b3;   text-align: center;">Login Time</th>
                    <th style="color: white; background-color:#0056b3;  text-align: center;">Logout Time</th>
                    <th style="color: white; background-color:#0056b3;  text-align: center;">Total Hours</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($sql_paginated)) { ?>
                    <tr>
                        <td><?php echo $row['EmployeeId']; ?></td>
                        <td><?php echo $row['LoginTime']; ?></td>
                        <td><?php echo $row['LogoutTime']; ?></td>
                        <td><?php echo $row['TotalHours']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
</body>

<?php include('footer.php'); ?>
