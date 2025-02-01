<?php
$result = ""; // Initialize the result message

if (isset($_GET['msg'])) {
    // Sanitize the message parameter to prevent XSS attacks
    $result = htmlspecialchars($_GET['msg']);
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>HRMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta charset="utf-8" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(0deg, #ffffff,#6A5ACD);
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            width: 100% auto;
            box-sizing: border-box;
        }

        .container-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;

        }

        .form-container {
            display: flex;
            background: linear-gradient(137deg, #ffffff, #6A5ACD);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 1000px;
            width: 100%;
        }

        .image-container {
            flex: 1;
            text-align: center;
            background: #f0f0f0;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-wrapper {
            flex: 1;
            padding: 40px;
            background-color: white;
            text-align: center;
        }

        h1 {
            color: #0277bd;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 26px;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 32px;
            color: black;
            margin-bottom: 15px;
        }

        h5 {
            color: #555;
            font-size: 14px;
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-control {
            height: 45px;
            padding-left: 50px;
            border-radius: 5px;
            transition: border-color 0.5s ease, box-shadow 0.3s ease;
        }

        .form-group .fa {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
        }

        .btn {
            height: 45px;
            border-radius: 12px;
            font-weight: bold;
            background: linear-gradient(135deg, #6A5ACD, black);
            color: #fff;
            width: 100%;
        }

        .btn:hover {
            background: linear-gradient(135deg, #01579b, #0277bd);
        }

        .message {
            color: #ffab00;
            margin-bottom: 15px;
        }

        .forgot-password {
            margin-top: 15px;
        }

        .forgot-password a {
            color: #0277bd;
            font-weight: 500;
        }

        .google-btn {
            background-color: #4285F4;
            color: white;
            border-radius: 12px;
            border: none;
            font-size: 16px;
            height: 45px;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .google-btn i {
            margin-right: 10px;
        }

        @media only screen and (max-width: 768px) {
            .form-container {
                flex-direction: column;
            }

            .image-container {
                max-height: 300px;
                flex-basis: auto;
            }

            h1 {
                font-size: 20px;
            }

            h2 {
                font-size: 24px;
            }

            h5 {
                font-size: 12px;
            }

            .form-container {
                margin-left: 0;
            }

            .btn {
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <div class="container-wrapper">
        <div class="form-container">
            <div class="image-container">
                <img src="image/Untitled.png" alt="Left Lavender Flower">
            </div>

            <div class="form-wrapper">
                <h1>Human Resource Management System</h1>
                <form action="controller/login.php" method="post">
                    <h2 class="text-center"><b>Login</b></h2>
                    <h5>Access the HRMS using your Email and Password</h5>
                    <div class="form-group">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="name" class="form-control" placeholder="Enter Email Address" required>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" id="Psw" class="form-control" placeholder="Enter Password" required>
                        <i class="fa fa-eye" title="Show Password" style="cursor:pointer;" onclick="togglePasswordVisibility()"></i>
                    </div>
                    <div class="message"><?php echo $result; ?></div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                    <div class="forgot-password">
                        <a href="changepassword.php">Forgot Password?</a>
                    </div>

                    <button type="button" class="google-btn">
                        <i class="fab fa-google"></i> Sign in with Google
                    </button>
                </form>
            </div>
        </div>
    </div>
    
<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("Psw");
        var eyeIcon = event.currentTarget;
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.title = "Hide Password";
        } else {
            passwordField.type = "password";
            eyeIcon.title = "Show Password";
        }
    }
</script>
</body>
</html>
