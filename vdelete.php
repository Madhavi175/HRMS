<?php
$mysqli = new mysqli("localhost", "root", "", "hr");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_GET["id"])) {
    // Prepare the delete statement
    $stmt = $mysqli->prepare("DELETE FROM `vacancy` WHERE vid = ?");
    if ($stmt) {
        $stmt->bind_param("i", $_GET["id"]);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            // Record deleted successfully
            header("location:viewvacancy.php");
            exit();
        } else {
            echo "Error: No record found with ID " . $_GET["id"];
        }

        $stmt->close();
    } else {
        echo "Error in prepared statement: " . $mysqli->error;
    }
} else {
    echo "Error: ID parameter missing.";
}

$mysqli->close();
?>
