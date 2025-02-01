<?php
// Start output buffering
ob_start();
include('header.php');

// Establish database connection
$con = new mysqli("localhost", "root", "", "hr");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Fetch project details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $s = "SELECT * FROM `project` WHERE pid = ?";
    $stmt = $con->prepare($s);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}

// Handle form submission for updating the project
if (isset($_POST['sub'])) {
    $pid1 = $_POST['pid1']; // Hidden field for original ID
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pmgr = $_POST['pmgr'];
    $ploc = $_POST['ploc'];

    $updateQuery = "UPDATE `project` SET pid=?, pname=?, pmgr=?, plocation=? WHERE pid=?";
    $stmt = $con->prepare($updateQuery);
    $stmt->bind_param("isssi", $pid, $pname, $pmgr, $ploc, $pid1);
    $stmt->execute();
    $stmt->close();

    // Redirect to view projects after update
    header("Location: viewproject.php");
    exit();
}

// Handle "Close" button
if (isset($_POST['sclose'])) {
    header("Location: viewproject.php");
    exit();
}

$con->close();
ob_end_flush(); // Send the output buffer and turn off output buffering
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Updation</title>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <style>
        body {
            background: url('../image/IMG_20170204_135243.jpg') no-repeat fixed center center;
            background-size: cover;
            font-family: Montserrat;
            margin: 0;
            padding: 0;
        }
        .login-block {
            width: 320px;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            margin: 40px auto;
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
            margin-top:10px;
            background: #008000;
            box-sizing: border-box;
            border-radius: 5px;
            border: none;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            cursor: pointer;
            outline: none;
        }
        .login-block button:hover {
            background: #ff7b81;
        }
    </style>
</head>
<body>
    <div class="login-block">
        <form method="post" action="">
            <h1>Project Updation</h1>
            <input type="hidden" name="pid1" value="<?php echo htmlspecialchars($row['pid']); ?>">
            Project Id:<br><input type="text" name="pid" value="<?php echo htmlspecialchars($row['pid']); ?>" required><br>
            Project Name:<br><input type="text" name="pname" value="<?php echo htmlspecialchars($row['pname']); ?>" required><br>
            Project Manager:<br><input type="text" name="pmgr" value="<?php echo htmlspecialchars($row['pmgr']); ?>" required><br>
            Project Location:<br><input type="text" name="ploc" value="<?php echo htmlspecialchars($row['plocation']); ?>" required><br>
            <button type="submit" name="sub">Update</button>
            <button type="submit" name="sclose">Close</button>
        </form>
    </div>
</body>
</html>

<?php include('footer.php'); ?>
