<?php
include('header.php');
include('db_connection.php');

if (isset($_GET['id'])) {
    $employeeId = $_GET['id'];

    // Fetch the existing payment details for the employee
    $sql = "SELECT * FROM employee_payments WHERE EmployeeId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employeeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p>No records found for Employee ID: $employeeId</p>";
        exit();
    }
} else {
    echo "<p>Invalid request</p>";
    exit();
}
?>

<style>
    .form-container {
        max-width: 600px; /* Set a maximum width for the form */
        margin: 20px auto; /* Center the form horizontally */
        padding: 20px;
        border: 1px solid #ccc; /* Border for the form */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        background-color: #f9f9f9; /* Light background color */
    }

    h1 {
        text-align: center; /* Center the heading */
        color: #333; /* Darker text color */
    }

    label {
        display: block; /* Block display for labels */
        margin: 10px 0 5px; /* Margin for spacing */
        font-weight: bold; /* Bold font for labels */
    }

    input[type="text"],
    input[type="number"],
    input[type="submit"] {
        width: 100%; /* Full-width input fields */
        padding: 10px; /* Padding inside input fields */
        margin-bottom: 15px; /* Space between inputs */
        border: 1px solid #ccc; /* Border for input fields */
        border-radius: 4px; /* Rounded corners */
        font-size: 16px; /* Font size */
    }

    input[type="submit"] {
        background-color: #007BFF; /* Button background color */
        color: white; /* Button text color */
        border: none; /* No border for the button */
        cursor: pointer; /* Pointer cursor for the button */
    }

    input[type="submit"]:hover {
        background-color: #0056b3; /* Darker button on hover */
    }
    .scrollable-container {
        max-height: 500px;
        overflow-y: auto;
        padding: 10px;
        background: #fff;
        border-radius: 4px;
        border: 1px solid #ddd;
        margin-top: 10px;
    }
</style>
<div class="scrollable-container">
<div class="form-container">
    <h1>Edit Payment Details</h1>
    <form action="update_payment.php" method="post">
        <input type="hidden" name="EmployeeId" value="<?php echo $row['EmployeeId']; ?>">
        
        <label for="Name">Name:</label>
        <input type="text" name="Name" id="Name" value="<?php echo $row['Name']; ?>" required>
        
        <label for="BankName">Bank Name:</label>
        <input type="text" name="BankName" id="BankName" value="<?php echo $row['BankName']; ?>" required>
        
        <label for="BranchName">Branch Name:</label>
        <input type="text" name="BranchName" id="BranchName" value="<?php echo $row['BranchName']; ?>" required>
        
        <label for="AccountNumber">Account Number:</label>
        <input type="text" name="AccountNumber" id="AccountNumber" value="<?php echo $row['AccountNumber']; ?>" required>
        
        <label for="IFSCCode">IFSC Code:</label>
        <input type="text" name="IFSCCode" id="IFSCCode" value="<?php echo $row['IFSCCode']; ?>" required>
        
        <label for="PANCard">PAN Card Number:</label>
        <input type="text" name="PANCard" id="PANCard" value="<?php echo $row['PANCard']; ?>" required>
        
        <label for="AadharCard">Aadhar Card Number:</label>
        <input type="text" name="AadharCard" id="AadharCard" value="<?php echo $row['AadharCard']; ?>" required>
        
        <label for="Address">Address:</label>
        <input type="text" name="Address" id="Address" value="<?php echo $row['Address']; ?>" required>
        
        <label for="Pincode">Pincode:</label>
        <input type="number" name="Pincode" id="Pincode" value="<?php echo $row['Pincode']; ?>" required>

        <input type="submit" value="Update Payment Details">
    </form>
</div>

<?php include('footer.php'); ?>
