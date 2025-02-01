<?php include('header.php'); ?>
<style>
    form {
        max-width: 900px;
        margin: 20px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input[type="text"], input[type="number"], select {
        width: 100%;
        padding: 8px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .form-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
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

    /* Flexbox container for form rows */
    .form-row {
        display: flex;
        gap: 20px; /* Space between columns */
        margin-bottom: 16px;
    }

    /* Ensure that all input fields inside a form row take up equal space */
    .form-row > div {
        flex: 1;
    }
</style>

<div class="scrollable-container">
<div class="form-container">
    <h1><b><center>Bank Details</center></b></h1>
    <form action="save_payment.php" method="post">
        <div class="form-row">
            <div>
                <label for="EmployeeId">Employee ID:</label>
                <input type="number" name="EmployeeId" id="EmployeeId" />
            </div>
            <div>
                <label for="Name">Name:</label>
                <input type="text" name="Name" id="Name" required>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="BankName">Bank Name:</label>
                <input type="text" name="BankName" id="BankName" required>
            </div>
            <div>
                <label for="BranchName">Branch Name:</label>
                <input type="text" name="BranchName" id="BranchName" required>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="AccountNumber">Account Number:</label>
                <input type="text" name="AccountNumber" id="AccountNumber" required>
            </div>
            <div>
                <label for="IFSCCode">IFSC Code:</label>
                <input type="text" name="IFSCCode" id="IFSCCode" required>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="PANCard">PAN Card Number:</label>
                <input type="text" name="PANCard" id="PANCard" required>
            </div>
            <div>
                <label for="AadharCard">Aadhar Card Number:</label>
                <input type="text" name="AadharCard" id="AadharCard" required>
            </div>
        </div>

        <div class="form-row">
            <div>
                <label for="Address">Address:</label>
                <input type="text" name="Address" id="Address" required>
            </div>
            <div>
                <label for="Pincode">Pincode:</label>
                <input type="number" name="Pincode" id="Pincode" required>
            </div>
        </div>

        <input type="submit" value="Save Payment Details">
    </form>
</div>

<?php include('footer.php'); ?>
