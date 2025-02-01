<?php
ob_start(); // Start output buffering
include('header.php');
include('db_connection.php'); // Include your database connection file

// Fetch employee payment data based on employee_id passed in the URL
if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];
    $query = "SELECT * FROM employee_payments WHERE EmployeeId='$employee_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['Name'];
        $salary = $row['Salary'];
        $reimbursement = $row['Reimbursement'];
        $loan_status = $row['LoanStatus'];
        $tax_deduction = $row['TaxDeduction'];
    } else {
        echo "Employee not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

// Handle form submission to update employee details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $salary = $_POST['salary'];
    $reimbursement = $_POST['reimbursement'];
    $loan_status = $_POST['loan_status'];
    $tax_deduction = $_POST['tax_deduction'];

    // Update the database with new data
    $update_query = "UPDATE employee_payments SET 
                        Name='$name', 
                        Salary='$salary', 
                        Reimbursement='$reimbursement', 
                        LoanStatus='$loan_status', 
                        TaxDeduction='$tax_deduction' 
                    WHERE EmployeeId='$employee_id'";

    if (mysqli_query($conn, $update_query)) {
        header('Location: accounting.php'); // Redirect to the main page after update
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Payment Details</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha3/css/bootstrap.min.css">

    <style>
        body {
            background-color: white;
        }
        .content-container {
            margin: 20px;
        }
    </style>
</head>
<body>

    <div class="container content-container">
        <h3>Edit Employee Payment Details</h3>

        <!-- Form to update employee payment details -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Employee Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control" id="salary" name="salary" value="<?php echo htmlspecialchars($salary); ?>" required>
            </div>

            <div class="mb-3">
                <label for="reimbursement" class="form-label">Reimbursement</label>
                <input type="number" class="form-control" id="reimbursement" name="reimbursement" value="<?php echo htmlspecialchars($reimbursement); ?>" required>
            </div>

            <div class="mb-3">
                <label for="loan_status" class="form-label">Loan Status</label>
                <select class="form-select" id="loan_status" name="loan_status" required>
                    <option value="Approved" <?php if ($loan_status == 'Approved') echo 'selected'; ?>>Approved</option>
                    <option value="Pending" <?php if ($loan_status == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Rejected" <?php if ($loan_status == 'Rejected') echo 'selected'; ?>>Rejected</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tax_deduction" class="form-label">Tax Deduction</label>
                <input type="number" class="form-control" id="tax_deduction" name="tax_deduction" value="<?php echo htmlspecialchars($tax_deduction); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Employee</button>
            <a href="accounting.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
mysqli_close($conn); // Close the database connection
include('footer.php');
ob_end_flush(); // End output buffering and flush the output
?>
