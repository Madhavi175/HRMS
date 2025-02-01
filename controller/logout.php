<?php
session_start();
include_once('connect.php');

// Check if 'User' exists in session
if (!isset($_SESSION['User'])) {
    // Redirect to the home page if the session is missing
    header('location:../index.php');
    exit;
}

$dbs = new database();
$db = $dbs->connection();

// Check if 'EmployeeId' exists in the session and handle the case when it's not set
if (!isset($_SESSION['User']['EmployeeId'])) {
    // Redirect if EmployeeId is not set
    header('location:../index.php');
    exit;
}

$emp = $_SESSION['User']['EmployeeId'];

// If EmployeeId is 1 (assuming this is an admin), log out immediately
if ($emp == 1) {
    unset($_SESSION['User']);
    session_destroy();
    header('location:../index.php');
    exit;
} else {
    // Check if email exists in session
    if (!isset($_SESSION['User']['Email'])) {
        // Redirect if email is not set
        header('location:../index.php');
        exit;
    }

    $email = $_SESSION['User']['Email'];
    date_default_timezone_set("Asia/Kolkata");
    $datetime = date("Y-m-d H:i:s");
    $date = date("Y-m-d");
    $empid = $_SESSION['User']['EmployeeId'];

    // Update employee logout time
    mysqli_query($db, "UPDATE employee SET LastLogout='$datetime' WHERE Email='$email'");

    // Check if 'dailyid' exists in session
    if (isset($_SESSION['dailyid'])) {
        $datetimeid = $_SESSION['dailyid'];

        // Query daily workload based on the available 'dailyid'
        $logindateid = mysqli_query($db, "SELECT * FROM dailyworkload WHERE DailyWorkLoadId='$datetimeid'");
        $LoginDate = mysqli_fetch_assoc($logindateid);

        if ($LoginDate) {
            $logind = $LoginDate['LoginDate'];

            /* hours count */
            $date1 = date($logind);
            $date2 = date($datetime);
            $hours = ((strtotime($date2) - strtotime($date1)) / 60);

            /* day count */
            $date11 = date_create($date1);
            $date22 = date_create($date2);
            $diff = date_diff($date11, $date22);
            $n = $diff->format("%a");

            // Update daily workload with logout time and working minutes
            mysqli_query($db, "UPDATE dailyworkload SET LogoutDate='$datetime', DailyWorkingminutes='$hours' WHERE EmpId='$empid' AND cast(LoginDate as date) = '$date'");
        }
    }

    // Destroy session and prepare for thank you message
    unset($_SESSION['User']);
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logout-message {
            text-align: center;
            background-color: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .logout-message h1 {
            color: #6A5ACD;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .logout-message p {
            font-size: 18px;
            color: #333;
        }

        .btn-home {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #6A5ACD;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-home:hover {
            background-color: #5a4cad;
        }
    </style>
</head>
<body>

<div class="logout-message">
    <h1>Thank You!</h1>
    <p>You have successfully logged out.</p>
    <p>Click the button below to go to the home page.</p>
    <button class="btn-home" onclick="window.location.href='../index.php'">Go to Home</button>
</div>

</body>
</html>
