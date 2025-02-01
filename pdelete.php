<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "hr");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Ensure that the 'id' parameter is set in the URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Use a prepared statement to securely delete the record
    $stmt = $con->prepare("DELETE FROM `project` WHERE pid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Redirect to the view project page
header("Location: viewproject.php");
exit();

// Close the database connection
$con->close();
?>
