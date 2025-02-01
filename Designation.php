<?php
ob_start(); // Start output buffering
include('header.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Designation Form</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <style>
        body {
            background: url('../image/IMG_20170204_135243.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: cursive;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-block {
            max-width: 460px;
            margin: 60px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-block h1 {
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

        .login-block input {
            width: calc(100% - 40px);
            height: 42px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 0 20px;
            font-size: 14px;
            outline: none;
        }

        .login-block button {
            width: 29%;
            height: 45px;
            background: blueviolet;
            border-radius: 5px;
            border: none;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 10px;
            transition: background 0.3s ease;
        }

        .login-block button:hover {
            background: black;
        }
    </style>
</head>
<body>

<div class="login-block">
    <form name="f1" action="" method="post">
        <h1><b>Designation</b></h1>
        <input type="number" name="emp_id" placeholder="Employee ID">
        <input type="text" name="name" placeholder="Designation" required>
        <button type="submit" name="sub">Submit</button>
        <button type="reset" name="reset">Reset</button>
    </form>
</div>

<?php
if (isset($_POST['sub'])) {
    $id = $_POST['emp_id'];
    $name = $_POST['name'];

    $con = new mysqli("localhost", "root", "", "hr");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $stmt = $con->prepare("INSERT INTO designation (emp_id, name) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ss", $id, $name);
        if ($stmt->execute()) {
            echo "<script>alert('Record added successfully');</script>";

            // Redirect to avoid resubmission on refresh
            header("Location: " . $_SERVER['PHP_SELF']);
            exit(); // Ensure no further script is executed after redirection
        } else {
            echo "<script>alert('Error adding record: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $con->error . "');</script>";
    }

    $con->close();
}
?>

<?php include('footer.php'); ?>
</body>
</html>

<?php
ob_end_flush(); // End output buffering and flush output
?>