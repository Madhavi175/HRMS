<?php
ob_start(); // Start output buffering

include('header.php');

// Use mysqli_* instead of deprecated mysql_*
$mysqli = new mysqli("localhost", "root", "", "hr");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$row = [];
if (isset($_GET["id"])) {
    $stmt = $mysqli->prepare("SELECT * FROM `vacancy` WHERE vid = ?");
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['sub'])) {
        $vid = $_POST['vid'];
        $vname = $_POST['vname'];
        $vidate = $_POST['vidate'];
        $vedate = $_POST['vedate'];
        $vpreq = $_POST['vpreq'];
        $vdreq = $_POST['vdreq'];

        // Prepare the update statement
        $stmt = $mysqli->prepare("UPDATE `vacancy` SET vname=?, vidate=?, vedate=?, vpreq=?, vdreq=? WHERE vid=?");
        if ($stmt) {
            $stmt->bind_param("sssssi", $vname, $vidate, $vedate, $vpreq, $vdreq, $vid);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                echo "Record updated successfully";
                header("Location: viewvacancy.php"); // Corrected spelling of the file name
                exit(); // Ensures no further code is executed
            } else {
                echo "No records updated. Please check your data.";
            }

            $stmt->close();
        } else {
            echo "Error in prepared statement: " . $mysqli->error;
        }
    }
}

// Close the connection
$mysqli->close();

ob_end_flush(); // Flush the output buffer and turn off output buffering
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS Vacancy Form</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <style>
        body {
            background: url('../image/IMG_20170204_135243.jpg') no-repeat fixed center center;
            background-size: cover;
            font-family: Montserrat, sans-serif;
        }

        .login-block {
            width: 320px;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            margin: 10px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .login-block h1 {
            text-align: center;
            color: #000;
            font-size: 18px;
            text-transform: uppercase;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .login-block input {
            width: 100%;
            height: 42px;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 14px;
            padding: 0 20px;
            outline: none;
        }

        .login-block button {
            width: 100%;
            height: 40px;
            background: #008000;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #e15960;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            outline: none;
            cursor: pointer;
        }

        .login-block button:hover {
            background: #ff7b81;
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
<div class="scrollable-container">
<div class="login-block">
    <form name="f1" action="" method="post">
        <h1>HRMS VACANCY</h1>
        <p>Vacancy ID:<input type="text" name="vid" value="<?php echo htmlspecialchars($row['vid'] ?? ''); ?>" required></p>
        <p>Vacancy Name:<input type="text" name="vname" value="<?php echo htmlspecialchars($row['vname'] ?? ''); ?>" required></p>
        <p>Issue Date:<input type="date" name="vidate" value="<?php echo htmlspecialchars($row['vidate'] ?? ''); ?>" required></p>
        <p>Expire Date:<input type="date" name="vedate" value="<?php echo htmlspecialchars($row['vedate'] ?? ''); ?>" required></p>
        <p>Post Required:<input type="text" name="vpreq" value="<?php echo htmlspecialchars($row['vpreq'] ?? ''); ?>" required></p>
        <p>Degree Required:<input type="text" name="vdreq" value="<?php echo htmlspecialchars($row['vdreq'] ?? ''); ?>" required></p>
        <button type="submit" name="sub">Update</button>
        <br><br>
        <button type="reset" name="reset">Reset</button>
    </form>
</div>
<?php include('footer.php'); ?>
</body>
</html>
