<?php
include('db_connection.php');

if (isset($_GET['id'])) {
    $employeeId = $_GET['id'];

    // Fetch the payment details for the employee
    $sql = "SELECT * FROM employee_payments WHERE EmployeeId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employeeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display the payment details
        echo "<div class='details-container'>";
        echo "<h1>Payment Details</h1>"; // Changed header
        echo "<p><strong>Name:</strong> " . $row['Name'] . "</p>";
        echo "<p><strong>Bank Name:</strong> " . $row['BankName'] . "</p>";
        echo "<p><strong>Branch Name:</strong> " . $row['BranchName'] . "</p>";
        echo "<p><strong>Account Number:</strong> " . $row['AccountNumber'] . "</p>";
        echo "<p><strong>IFSC Code:</strong> " . $row['IFSCCode'] . "</p>";
        echo "<p><strong>PAN Card:</strong> " . $row['PANCard'] . "</p>";
        echo "<p><strong>Aadhar Card:</strong> " . $row['AadharCard'] . "</p>";
        echo "<p><strong>Address:</strong> " . $row['Address'] . "</p>";
        echo "<p><strong>Pincode:</strong> " . $row['Pincode'] . "</p>";
        echo "</div>";
    } else {
        echo "<p>No records found for Employee ID: $employeeId</p>";
    }
} else {
    echo "<p>Invalid request</p>";
}
?>

<!-- Print Button -->
<div class="print-button">
    <button onclick="window.print();">Print</button>
</div>

<style>
    /* Reset margin and padding for body */
    body {
        margin: 0; /* Remove default margin */
        padding: 0; /* Remove default padding */
        font-family: Arial, sans-serif; /* Set font for the page */
        background-color: #f0f0f0; /* Light background color for the page */
    }

    .details-container {
        width: 100%; /* Full width */
        max-width: 800px; /* Optional maximum width for readability */
        margin: 20px auto; /* Center the container */
        padding: 20px;
        border: 1px solid #ccc; /* Border for the details container */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        background-color: white; /* White background for the details container */
    }

    h1 {
        text-align: center; /* Center the heading */
        color: #333; /* Darker text color */
    }

    p {
        font-size: 16px; /* Font size for paragraphs */
        line-height: 1.5; /* Line height for readability */
        margin: 10px 0; /* Margin for spacing between paragraphs */
    }

    strong {
        color: #007BFF; /* Color for labels */
    }

    .print-button {
        text-align: center; /* Center the button */
        margin-top: 20px; /* Space above the button */
    }

    button {
        padding: 10px 20px; /* Padding for the button */
        background-color: #007BFF; /* Button background color */
        color: white; /* Button text color */
        border: none; /* No border for the button */
        border-radius: 5px; /* Rounded corners */
        cursor: pointer; /* Pointer cursor for the button */
        font-size: 16px; /* Font size for button text */
    }

    button:hover {
        background-color: #0056b3; /* Darker button on hover */
    }

    /* Print styles */
    @media print {
        @page {
            margin: 0; /* Remove default page margins */
        }

        body {
            background: none; /* Remove background for print */
            color: black; /* Set text color to black */
        }

        /* Hide the print button */
        .print-button {
            display: none; /* Do not show print button */
        }
    }
</style>
