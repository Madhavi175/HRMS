<?php
ob_start();  // Start output buffering
include('header.php');
?>
<?php
include('db_connection.php');

// Insert form data into the database
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $shift = $_POST['shift'];
    $year = $_POST['year'];
    $from_month = $_POST['from_month'];
    $to_month = $_POST['to_month'];
    $duration = $_POST['duration'];

    $query = "INSERT INTO payroll_info (Name, Department, Shift, Year, FromMonth, ToMonth, Duration) 
              VALUES ('$name', '$department', '$shift', '$year', '$from_month', '$to_month', '$duration')";
    if (mysqli_query($conn, $query)) {
        header('Location: payroll.php');
        exit();  // Ensure no further code is executed after redirection
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM payroll_info WHERE id='$delete_id'";
    if (mysqli_query($conn, $delete_query)) {
        header('Location: payroll.php'); // Redirect after deletion
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<style>
    body {
        background-color: white;
        font-family: Arial, sans-serif;
    }

    /* Form container with medium size */
   /* Form container with medium size */
.form-container {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin-top: 20px;
}

/* Margin-bottom for each form element to avoid overlap */
.form-container .mb-3 {
    margin-bottom: 20px; /* Increased margin to separate fields */
}

.form-label {
    font-weight: bold;
}

.form-select, 
.form-control, 
.btn-primary {
    border-radius: 0px;
    box-shadow: none;
    margin-top: 5px; /* Added space between label and input fields */
}

.btn-primary {
    background-color: dodgerblue;
    padding: 10px 20px;
    transition: background-color 0.3s ease-in-out;
    width: 150px;
    display: block;
    margin: 0 auto;
}

.btn-primary:hover {
    background-color: green;
}

/* Adding padding and margin for table layout */
.table-container {
    width: 100%;
    margin-top: 30px;
    padding: 10px;
}

table.table {
    width: 100%;
    border-collapse: collapse;
}

table.table th,
table.table td {
    text-align: center;
    padding: 10px;
    border: 1px solid #ddd;
}

table.table th {
    background-color: #004085;
    color: white;
    font-weight: bold;
}

table.table tr:nth-child(even), 
table.table tr:nth-child(odd) {
    background-color: #f2f2f2;
}

table.table tr:hover {
    background-color: #e9ecef;
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

<body>
<div class="scrollable-container">
    <div class="container mt-5">
        <div class="form-container">
            <h3><center><b><mark>Add Payroll Information</mark></b></center></h3>

            <!-- Payroll Input Form -->
            <form method="POST" action="">
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                </div>

                <!-- Department dropdown -->
                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <select name="department" class="form-select" required>
                        <option value="">Select Department</option>
                        <option value="Admin">Admin</option>
                        <option value="HR">HR</option>
                        <option value="Employee">Employee</option>
                        <option value="Finance">Finance</option>
                    </select>
                </div>

                <!-- Shift -->
                <div class="mb-3">
                    <label for="shift" class="form-label">Shift</label>
                    <select name="shift" class="form-select" required>
                        <option value="">Select Shift</option>
                        <option value="Morning">Morning</option>
                        <option value="Afternoon">Afternoon</option>
                        <option value="Night">Night</option>
                    </select>
                </div>

                <!-- Year -->
                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" name="year" class="form-control" placeholder="Enter Year" required>
                </div>

                <!-- From Month -->
                <div class="mb-3">
                    <label for="from_month" class="form-label">From Month</label>
                    <select name="from_month" class="form-select" required>
                        <option value="">Select From Month</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>

                <!-- To Month -->
                <div class="mb-3">
                    <label for="to_month" class="form-label">To Month</label>
                    <select name="to_month" class="form-select" required>
                        <option value="">Select To Month</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>

                <!-- Duration -->
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <select name="duration" class="form-select" required>
                        <option value="">Select Duration</option>
                        <option value="3 months">3 Months</option>
                        <option value="6 months">6 Months</option>
                        <option value="12 months">12 Months</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- Display Records -->
        <div class="table-container">
            <h4><mark><center><b>Payroll Records</b></center></mark></h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="background-color:#004085;color: white; font-weight:bold">Sr. No.</th>
                        <th style="background-color:#004085;color: white; font-weight:bold">Name</th>
                        <th style="background-color:#004085;color: white; font-weight:bold">Department</th>
                        <th style="background-color:#004085;color: white; font-weight:bold">Shift</th>
                        <th style="background-color:#004085;color: white; font-weight:bold" >Year</th>
                        <th style="background-color:#004085;color: white; font-weight:bold">From Month</th>
                        <th style="background-color:#004085;color: white; font-weight:bold">To Month</th>
                        <th style="background-color:#004085;color: white; font-weight:bold">Duration</th>
                        <th style="background-color:#004085;color: white; font-weight:bold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM payroll_info";
                    $result = mysqli_query($conn, $query);
                    $sr_no = 1;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$sr_no}</td>
                                    <td>{$row['Name']}</td>
                                    <td>{$row['Department']}</td>
                                    <td>{$row['Shift']}</td>
                                    <td>{$row['Year']}</td>
                                    <td>{$row['FromMonth']}</td>
                                    <td>{$row['ToMonth']}</td>
                                    <td>{$row['Duration']}</td>
                                    <td><button class='btn btn-danger delete-btn' data-id='{$row['id']}'>Delete</button></td>
                                  </tr>";
                            $sr_no++;
                        }
                    } else {
                        echo "<tr><td colspan='9'>No records found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.delete-btn').click(function(){
        var deleteId = $(this).data('id');
        var confirmation = confirm("Are you sure you want to delete this record?");
        
        if (confirmation) {
            // Redirect to the delete action
            window.location.href = "payroll.php?delete_id=" + deleteId;
        }
    });
});
</script>

</body>
</html>

<?php
include('footer.php');
ob_end_flush();  // End output buffering and flush output
?>
