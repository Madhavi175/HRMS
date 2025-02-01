<?php
include_once('controller/connect.php');

$dbs = new database();
$db = $dbs->connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employeeId = $_POST['employee_id'] ?? '';

    if ($employeeId) {
        // Delete the employee record from employees_data table
        $deleteQuery = "DELETE FROM employees_data WHERE EmployeeId = ?";
        $stmt = mysqli_prepare($db, $deleteQuery);
        mysqli_stmt_bind_param($stmt, 's', $employeeId);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect back to the employee view page
            header('Location: employee_view.php');
            exit();
        } else {
            echo "Error deleting employee: " . mysqli_error($db);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "No employee ID specified.";
    }
}

mysqli_close($db);
?>
