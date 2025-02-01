<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'hr');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture form data
    $employeeId = $_POST['EmployeeId'];
    $name = $_POST['Name'];
    $bankName = $_POST['BankName'];
    $accountNumber = $_POST['AccountNumber'];
    $ifscCode = $_POST['IFSCCode'];
    $branchName = $_POST['BranchName'];
    $panCard = $_POST['PANCard'];
    $aadharCard = $_POST['AadharCard'];
    $address = $_POST['Address'];
    $pincode = $_POST['Pincode'];

    // Prepare SQL query to insert data into the employee_payments table
    $stmt = $conn->prepare("INSERT INTO employee_payments (EmployeeId, BankName, Name, AccountNumber, IFSCCode, BranchName, PANCard, AadharCard, Address, Pincode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the prepare statement failed
    if ($stmt === false) {
        die("Error preparing the SQL statement: " . $conn->error);
    }

    // Bind parameters to the prepared statement (i for integer, s for string)
    $stmt->bind_param('issssssssi', $employeeId, $bankName, $name, $accountNumber, $ifscCode, $branchName, $panCard, $aadharCard, $address, $pincode);

    // Execute the query
    if ($stmt->execute()) {
        echo "Payment details saved successfully!";
        header("Location: payment.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
