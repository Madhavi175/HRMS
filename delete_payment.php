<?php
include('db_connection.php'); // Ensure this file has the connection to your database

if (isset($_GET['id'])) {
    $employeeId = $_GET['id'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM employee_payments WHERE EmployeeId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employeeId);

    if ($stmt->execute()) {
        // Redirect back to the payment view with a success message
        header("Location: paymentview.php?message=Record deleted successfully");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
