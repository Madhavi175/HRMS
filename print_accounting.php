<?php
include('db_connection.php'); // Include your database connection file

// Fetch employee payment data based on employee_id passed in the URL
if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];
    $query = "SELECT * FROM employee_payments WHERE EmployeeId='$employee_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Employee not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Employee Payment Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha3/css/bootstrap.min.css">
    <style>
        body {
            background-color: white;
            margin: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #004085;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Employee Payment Details</h1>

    <table>
        <tr>
            <th>Employee ID</th>
            <td><?php echo htmlspecialchars($row['EmployeeId']); ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo htmlspecialchars($row['Name']); ?></td>
        </tr>
        <tr>
            <th>Salary</th>
            <td>$<?php echo htmlspecialchars($row['Salary']); ?></td>
        </tr>
        <tr>
            <th>Reimbursement</th>
            <td>$<?php echo htmlspecialchars($row['Reimbursement']); ?></td>
        </tr>
        <tr>
            <th>Loan Status</th>
            <td><?php echo htmlspecialchars($row['LoanStatus']); ?></td>
        </tr>
        <tr>
            <th>Tax Deduction</th>
            <td>$<?php echo htmlspecialchars($row['TaxDeduction']); ?></td>
        </tr>
    </table>

    <script>
        window.print(); // Automatically open the print dialog
    </script>
    
</body>
</html>

<?php
mysqli_close($conn); // Close the database connection
?>
