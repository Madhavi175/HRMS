<?php include('header.php');?>

<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "hr");

// Fetch all employee data for the dropdown
$query = "SELECT Employeeid, FirstName, MiddleName, LastName, Salary FROM employees_data";
$employeeList = mysqli_query($conn, $query);

$selectedEmployeeId = "";
$results = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the selected EmployeeId from the form
    $selectedEmployeeId = mysqli_real_escape_string($conn, $_POST['employeeId']);
    
    // Fetch the employee's details based on the selected EmployeeId
    if (!empty($selectedEmployeeId)) {
        $query = "SELECT Employeeid, FirstName, MiddleName, LastName,Salary,  SalaryPaid, SalaryUnpaid 
                  FROM employees_data 
                  WHERE Employeeid='$selectedEmployeeId'";
        $results = mysqli_query($conn, $query);
    }

    // Check if the form also submitted Salary Paid and Unpaid fields
    if (isset($_POST['salaryPaid']) && isset($_POST['salaryUnpaid'])) {
        $salaryPaid = mysqli_real_escape_string($conn, $_POST['salaryPaid']);
        $salaryUnpaid = mysqli_real_escape_string($conn, $_POST['salaryUnpaid']);
        $employeeId = mysqli_real_escape_string($conn, $_POST['employeeId']);

        // Update the employee's salary paid and unpaid in the database
        $updateQuery = "UPDATE employees_data 
                        SET SalaryPaid='$salaryPaid', SalaryUnpaid='$salaryUnpaid' 
                        WHERE Employeeid='$employeeId'";
        mysqli_query($conn, $updateQuery);

        // After updating, reload the page to fetch the updated data
        echo "<script>window.location.href='salary.php?employeeId=$employeeId';</script>";
        exit();
    }
}

// If there's a GET request with employeeId, fetch the details
if (isset($_GET['employeeId'])) {
    $selectedEmployeeId = mysqli_real_escape_string($conn, $_GET['employeeId']);
    $query = "SELECT Employeeid, FirstName, MiddleName, LastName,Salary,  SalaryPaid, SalaryUnpaid 
              FROM employees_data 
              WHERE Employeeid='$selectedEmployeeId'";
    $results = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>HRMS Salary Info</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
            background-size: cover;
           
             background-color: white;  
        }
        .form-container {
            margin: 90px auto;
            width: 600px;
            text-align: center;
            /* height: 700px; */
            /* box-shadow: 0 0 10px rgba(0,0,0,0.1); */
        }
        select, button {
            padding: 10px;
            margin: 5px;
            width: 300px;
           
        }
        select{
            border: 5px solid #ccc;
             color: #004085;
             font-weight: bolder;
        }
        button{
            background-color: #004085;
            color: white;
            font-size: 15px;
            font-weight: bold;
        }
        button:hover{
            background-color: grey;
        }
        .table-container {
            width: 900px;
            margin-left: 30px;
            max-height: 400px;
            /* overflow-y: auto; */
            /* border: 1px solid black; */
            /* opacity: 0.95; */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid black;
        }
        th {
            background-color: #004085;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #cce5ff;
        }
        tr:nth-child(odd) {
            background-color: #f8f9fa;
        }
        h2 {
            color: DodgerBlue;
            text-align: center;
            font-weight: 500;
            margin-bottom: 5px;
            font-size: 27px;
            letter-spacing: 1px;
            margin-top: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            position: relative;
            padding-bottom: 10px; 
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
</head>
<body>
    <!-- <h2><b>HRMS SALARY DETAILS</b></h2> -->

    <div class="scrollable-container">
        <div class="form-container">
        <h2><b>HRMS SALARY DETAILS</b></h2>
            <form method="POST" action="salary.php">
            
                <select name="employeeId" required>
                    <option value="">Select Employee</option>
                    <?php while ($row = mysqli_fetch_array($employeeList)) { ?>
                        <option value="<?php echo $row['Employeeid']; ?>">
                            <?php echo $row['Employeeid'] . " - " . $row['FirstName'] . " " . $row['MiddleName'] . " " . $row['LastName']; ?>
                        </option> 
                    <?php } ?>
                </select>
                <br>
                <button type="submit">View Salary</button>
            </form>
              </div>
 
        <?php if ($results && mysqli_num_rows($results) > 0) { ?>
        <div class="table-container">
            <form method="POST" action="salary.php">
                <table>
                    <tr>
                        <th>EMPLOYEE ID</th>
                        <th>FIRST NAME</th>
                        <th>MIDDLE NAME</th>
                        <th>LAST NAME</th>
                        <th>Salary</th>
                        <th>SALARY PAID</th>
                        <th>SALARY UNPAID</th>
                        <th>ACTION</th>
                    </tr>
                    <?php while($row = mysqli_fetch_array($results)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['Employeeid']); ?></td>
                            <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
                            <td><?php echo htmlspecialchars($row['MiddleName']); ?></td>
                            <td><?php echo htmlspecialchars($row['LastName']); ?></td>
                            <td><?php echo htmlspecialchars($row['Salary']); ?></td>

                            <td>
                                <input type="text" name="salaryPaid" value="<?php echo htmlspecialchars($row['SalaryPaid']); ?>">
                            </td>
                            <td>
                                <input type="text" name="salaryUnpaid" value="<?php echo htmlspecialchars($row['SalaryUnpaid']); ?>">
                            </td>
                            <td>
                                <input type="hidden" name="employeeId" value="<?php echo $row['Employeeid']; ?>">
                                <button type="submit">Save</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </form>
        </div>
        <?php } elseif ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
            <p style="color: red; text-align: center;">No matching records found.</p>
        <?php } ?>
        </div>
</body>
</html>
<br>
<?php include('footer.php');?>
