<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $employeeId = $_POST['EmployeeId'];
    $name = $_POST['Name'];
    $bankName = $_POST['BankName'];
    $branchName = $_POST['BranchName'];
    $accountNumber = $_POST['AccountNumber'];
    $ifscCode = $_POST['IFSCCode'];
    $panCard = $_POST['PANCard'];
    $aadharCard = $_POST['AadharCard'];
    $address = $_POST['Address'];
    $pincode = $_POST['Pincode'];

    // Update the payment details in the database
    $sql = "UPDATE employee_payments SET Name=?, BankName=?, BranchName=?, AccountNumber=?, IFSCCode=?, PANCard=?, AadharCard=?, Address=?, Pincode=? WHERE EmployeeId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $name, $bankName, $branchName, $accountNumber, $ifscCode, $panCard, $aadharCard, $address, $pincode, $employeeId);

    if ($stmt->execute()) {
        // Redirect back to the payment view with a success message
        header("Location: paymentview.php?message=Record updated successfully");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "<p>Invalid request</p>";
}
?>
