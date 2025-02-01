<?php
// view_payments.php
include('header.php');
include('db_connection.php');

// Pagination Logic
$limit = 10; // Number of entries per page
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;

// Fetch data from the database with error handling
$sql = "SELECT * FROM employee_payments LIMIT $offset, $limit";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error in query: " . mysqli_error($conn)); // Show the error message if the query fails
}

// Count total records for pagination
$total_results = mysqli_query($conn, "SELECT COUNT(*) FROM employee_payments");
if (!$total_results) {
    die("Error in counting records: " . mysqli_error($conn)); // Error check for the count query
}
$total_records = mysqli_fetch_array($total_results)[0];
$total_pages = ceil($total_records / $limit);
?>

<style>
    body {
        background-color: white;
    }

    table {
        width: 100%;
        margin-left: 20px;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }
th{
    background-color: #004085;
    color: white;
    padding: 10px;
}
    .pagination {
        margin-top: 20px;
        margin-left: 20px;
    }

    .pagination a {
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid #ddd;
        color: #007BFF;
    }

    .pagination a.active {
        background-color: #007BFF;
        color: white;
        border: 1px solid #007BFF;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }

    /* Dropdown Menu */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }

    .btn {
        padding: 8px 12px;
        border: none;
        color: grey;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
    }

    .btn-edit {
        background-color: #007BFF;
        color: white;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-print {
        background-color: #28a745;
        color: white;
    }

    .btn:hover {
        opacity: 0.8;
    }
</style>

<body>
<div class="scrollable-container">
    <div class="form-container">
        <h1><center>Payment Details</center></h1>

        <!-- Table to Display Payment Details -->
        <table>
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Bank Name</th>
                    <th>Branch Name</th>
                    <th>Account Number</th>
                    <th>IFSC Code</th>
                    <th>PAN Card</th>
                    <th>Aadhar Card</th>
                    <th>Address</th>
                    <th>Pincode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['EmployeeId'] . "</td>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['BankName'] . "</td>";
                        echo "<td>" . $row['BranchName'] . "</td>";
                        echo "<td>" . $row['AccountNumber'] . "</td>";
                        echo "<td>" . $row['IFSCCode'] . "</td>";
                        echo "<td>" . $row['PANCard'] . "</td>";
                        echo "<td>" . $row['AadharCard'] . "</td>";
                        echo "<td>" . $row['Address'] . "</td>";
                        echo "<td>" . $row['Pincode'] . "</td>";
                        echo "<td class='action-buttons'>"; // Start Action Buttons Column
                        echo "<div class='dropdown'>";
                        echo "<button class='btn dropbtn'>Actions</button>";
                        echo "<div class='dropdown-content'>";
                        echo "<a href='edit_payment.php?id=" . $row['EmployeeId'] . "' class='btn-edit'>Edit</a>";
                        echo "<a href='delete_payment.php?id=" . $row['EmployeeId'] . "' class='btn-delete' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>";
                        echo "<a href='print_payment.php?id=" . $row['EmployeeId'] . "' class='btn-print'>Print</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</td>"; // End Action Buttons Column
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No records found</td></tr>"; // Adjusted colspan
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo "<a class='active' href='paymentview.php?page=" . $i . "'>" . $i . "</a>";
                } else {
                    echo "<a href='paymentview.php?page=" . $i . "'>" . $i . "</a>";
                }
            }
            ?>
        </div>
    </div>
</div>
</body>

<?php include('footer.php'); ?>
