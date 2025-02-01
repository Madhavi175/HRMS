<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS Projects</title>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <style>
        body {
            background: url('../image/IMG_20170204_135243.jpg') no-repeat fixed center center;
            background-size: cover;
            font-family: Montserrat, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: white;
        }
        .login-block {
            width: 700px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            
        }
        .login-block h1 {
            color: DodgerBlue;
            font-size: 30px;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .login-block input {
            width: 500px;
            height: 42px;
            border-radius: 10px;
            border: 2px solid #ccc;
            margin-bottom: 20px;
            font-size: 14px;
            padding: 0 20px;
            outline: none;
            font-weight: bold;
            margin-left: 20px;
        }

       
        .login-block button {
            width: 300px;
            height: 45px;
            background: deepskyblue;
            border-radius: 20px;
            border: none;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .login-block button:hover {
            background: green;
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
    <script>
        function validateForm() {
            var id = document.forms["f1"]["eid"].value;
            if (id == "" || isNaN(id) || id.length < 3) {
                alert("Please enter a valid Project ID with at least 3 digits.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div class="scrollable-container">
<div class="login-block">
    <form name="f1" action="" method="post" onsubmit="return validateForm()">
        <h1>HRMS Projects</h1>
        <p style="color:dimgray; font-weight:bold;  font-size: 15px;" >Project ID :-<input type="text" name="pid" placeholder="eg: 123" required></p>
        <p style="color:dimgray; font-weight:bold;  font-size: 15px;" >Project ID :-<input type="text" name="pid" placeholder="eg: 123" required></p>
        <p style="color: dimgray; font-weight:bold;  font-size: 15px;" >Project Name :-<input type="text" name="pname" placeholder="eg: Website" required></p>
        <p style="color: dimgray; font-weight:bold;  font-size: 15px;" >Project Manager :-<input type="text" name="pmgr" placeholder="eg: ABCD" required></p>
        <p style="color: dimgray; font-weight:bold;  font-size: 15px;" >Project Location :-<input type="text" name="plocation" placeholder="eg: Bangalore" required></p>
        <button type="submit" name="sub">Submit</button>
        <br><br>
        <button type="reset">Reset</button>
    </form>
</div>

<?php
if (isset($_POST['sub'])) {
    $id = $_POST['pid'];
    $name = $_POST['pname'];
    $mgr = $_POST['pmgr'];
    $loc = $_POST['plocation'];

    $con = new mysqli("localhost", "root", "", "hr");

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $stmt = $con->prepare("INSERT INTO `project` (`pid`, `pname`, `pmgr`, `plocation`) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id, $name, $mgr, $loc);

    if ($stmt->execute()) {
        echo "<script>alert('Project added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding project.');</script>";
    }

    $stmt->close();
    $con->close();
}
?>

<?php include('footer.php'); ?>
</body>
</html>
