<?php include('header.php'); ?>
<?php
// Include database connection file
include_once('controller/connect.php'); // This assumes the path is correct

if (isset($_POST['submit'])) {
    // Sanitize and escape input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success'>Thank you for your feedback!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error submitting feedback: " . mysqli_error($conn) . "</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS Feedback Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .feedback-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .feedback-container h2 {
            text-align: center;
            color: #483D8B;
            margin-bottom: 20px;
        }

        .feedback-container label {
            font-weight: bold;
        }

        .feedback-container button {
            background-color: #6A5ACD;
            color: #fff;
            border: none;
        }

        .feedback-container button:hover {
            background-color: #483D8B;
        }
    </style>
</head>
<body>

<div class="feedback-container">
    <h2>HRMS Feedback Form</h2>
    <form method="post" action="feedback.php">
        <div class="form-group">
            <label for="name">Your Name:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
        </div>

        <div class="form-group">
            <label for="email">Your Email:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label for="feedback">Your Feedback:</label>
            <textarea name="feedback" id="feedback" class="form-control" rows="5" placeholder="Enter your feedback" required></textarea>
        </div>

        <button type="submit" name="submit" class="btn btn-primary btn-block">Submit Feedback</button>
    </form>
</div>
<?php include('footer.php'); ?>
</body>
</html>
