<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS Vacancy Form</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <style>
        body {
           
            background-size: cover;
            font-family: Montserrat, sans-serif;
            background-color: white;
        }

        .logo {
            width: 213px;
            height: 36px;
            background: url('') no-repeat;
            margin: 10px auto;
        }

        .login-block {
            width: 700px;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            margin: 4px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: -8px;
        }

        .login-block h1 {
            text-align: center;
            color: #000;
            font-size: 30px;
            color: DodgerBlue;
            text-transform: uppercase;
            margin-top: 0;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .login-block input {
            width: 500px;
            height: 42px;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 14px;
            padding: 0 20px;
            outline: none;
            font-weight: bold;
            margin-left: 20px;
        }

        .login-block input#username {
            background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
            background-size: 16px 80px;
        }

        .login-block input#username:focus {
            background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
            background-size: 16px 80px;
        }

        .login-block input#password {
            background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
            background-size: 16px 80px;
        }

        .login-block input#password:focus {
            background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
            background-size: 16px 80px;
        }

        .login-block input:active, .login-block input:focus {
            border: 1px solid #ff656c;
        }

        .login-block button {
            width: 300px;
            height: 45px;
            background: deepskyblue;
           
            border-radius: 20px;
            border: 1px solid #fff;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            outline: none;
            cursor: pointer;
           margin-left:170px;
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
</head>
<body>
<div class="scrollable-container">

<div class="logo"></div>
<div class="login-block">
    <form name="f1" action="" method="post">
        <h1>HRMS VACANCY</h1>
        <p>Vacancy ID :-<input type="text" name="vid" placeholder="eg: 123" required></p>
        <p>Vacancy Name :-<input type="text" name="vname" placeholder="eg: Developer" required></p>
        <p>Issue Date :-<input type="date" name="vidate" placeholder="YYYY-MM-DD" required></p>
        <p>Expire Date :-<input type="date" name="vedate" placeholder="YYYY-MM-DD" required></p>
        <p>Post Required :-<input type="text" name="vpreq" placeholder="eg: Senior Developer" required></p>
        <p>Degree Required :-<input type="text" name="vdreq" placeholder="eg: B.E" required></p>
        <button type="submit" name="sub">Submit</button>
        <br><br>
        <button type="reset" name="reset">Reset</button>
    </form>
</div>

<?php

if (isset($_POST['sub'])) {
 
    $vid = $_POST['vid'];
    $vname = $_POST['vname'];
    $vidate = $_POST['vidate'];
    $vedate = $_POST['vedate'];
    $vpreq = $_POST['vpreq'];
    $vdreq = $_POST['vdreq'];

    
    $mysqli = new mysqli("localhost", "root", "", "hr");

   
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("INSERT INTO `vacancy` (`vid`, `vname`, `vidate`, `vedate`, `vpreq`, `vdreq`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $vid, $vname, $vidate, $vedate, $vpreq, $vdreq);
    
    if ($stmt->execute()) {
        echo "<p>Record inserted successfully.</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $mysqli->close();
}
?>

<?php include('footer.php'); ?>

</body>
</html>
