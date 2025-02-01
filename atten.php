<?php
// Start output buffering
ob_start();

include('header.php');
include_once('controller/connect.php');

$dbs = new database();
$db = $dbs->connection();

$employees = [];

// Fetch all employee data including DaysPresent
$employeeQuery = "SELECT EmployeeId, CONCAT(FirstName, ' ', MiddleName, ' ', LastName) AS FullName, DaysPresent FROM employees_data";
$employeeResult = mysqli_query($db, $employeeQuery);

if (!$employeeResult) {
    die("Error fetching employee data: " . mysqli_error($db));
}

// Store employee data
while ($row = mysqli_fetch_assoc($employeeResult)) {
    $employeeId = $row['EmployeeId'];
    $employees[$employeeId] = [
        'FullName' => $row['FullName'],
        'DaysPresent' => $row['DaysPresent']
    ];
}

// Handle manual updates
if (isset($_POST['update'])) {
    $employeeIdToUpdate = $_POST['employeeId'];
    $newDays = $_POST['daysPresent'];

    // Update the DaysPresent column
    $updateQuery = "UPDATE employees_data SET DaysPresent = ? WHERE EmployeeId = ?";
    $stmt = mysqli_prepare($db, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'ii', $newDays, $employeeIdToUpdate);

    if (mysqli_stmt_execute($stmt)) {
        // Redirect to avoid form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($db);
    }

    mysqli_stmt_close($stmt);
}

// Handle delete request
if (isset($_GET['delete'])) {
    $employeeIdToDelete = $_GET['delete'];
    // Delete the employee record
    $deleteQuery = "DELETE FROM employees_data WHERE EmployeeId = ?";
    $stmt = mysqli_prepare($db, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'i', $employeeIdToDelete);

    if (mysqli_stmt_execute($stmt)) {
        // Refresh the page to reflect changes
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($db);
    }

    mysqli_stmt_close($stmt);
}

// Close database connection
mysqli_close($db);

// End output buffering and flush output
ob_end_flush();
?>

<style>
    .validation-form h2 {
        color: DodgerBlue;
        text-align: center;
        font-weight: 500;
        margin-bottom: 10px;
        font-size: 27px;
        letter-spacing: 1px;
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

<ol class="breadcrumb" style="margin: 10px 0px !important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Employee View</li>
</ol>

<div class="scrollable-container">
    <div class="validation-form" style="margin-bottom: 30px;">
        <h2><b>Employee View</b></h2>

        <!-- Form to select month and year -->
        <form method="post" action="">
            <div class="row">
                <div class="col-md-4">
                    <label for="month">Month:</label>
                    <input type="number" id="month" name="month" min="1" max="12" value="<?php echo isset($_POST['month']) ? htmlspecialchars($_POST['month']) : '1'; ?>">
                </div>
                <div class="col-md-4">
                    <label for="year">Year:</label>
                    <input type="number" id="year" name="year" value="<?php echo isset($_POST['year']) ? htmlspecialchars($_POST['year']) : date('Y'); ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" name="calculate" class="btn btn-primary">Calculate</button>
                </div>
            </div>
        </form>

        <div class="row" style="color: white; margin-right: 0; margin-left:0;">
            <div class="col-md-4" style="height: 40px; background-color: #20B2AA;">
                <label>Name</label>
            </div>
            <div class="col-md-4" style="height: 40px; background-color: #20B2AA;">
                <label>Employee ID</label>
            </div>
            <div class="col-md-2" style="height: 40px; background-color: #20B2AA;">
                <label>Days Present</label>
            </div>
            <div class="col-md-2" style="height: 40px; background-color: #20B2AA;">
                <label>Actions</label>
            </div>
        </div>

        <?php if (!empty($employees)) : ?>
            <?php foreach ($employees as $employeeId => $data) : ?>
                <div class="row" style="margin-right: 0; margin-left: 0;">
                    <div class="col-md-4">
                        <label><?php echo htmlspecialchars($data['FullName']); ?></label>
                    </div>
                    <div class="col-md-4">
                        <label><?php echo htmlspecialchars($employeeId); ?></label>
                    </div>
                    <div class="col-md-2">
                        <label><?php echo htmlspecialchars($data['DaysPresent']); ?></label>
                    </div>
                    <div class="col-md-2">
                        <!-- Update Form -->
                        <form method="post" action="">
                            <input type="hidden" name="employeeId" value="<?php echo htmlspecialchars($employeeId); ?>">
                            <input type="number" name="daysPresent" value="<?php echo htmlspecialchars($data['DaysPresent']); ?>" min="0">
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </form>
                        <!-- Delete Button -->
                        <a href="?delete=<?php echo urlencode($employeeId); ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
                <hr style="margin-bottom: 10px; margin-top: 5px; border-top: 1px solid #eee;">
            <?php endforeach; ?>
        <?php else : ?>
            <p>No data to display.</p>
        <?php endif; ?>

        <?php
        if (isset($_POST['calculate'])) {
            $month = $_POST['month'];
            $year = $_POST['year'];

            // Display calculated days for each employee
            echo '<h3>Days Present in ' . date('F Y', strtotime("$year-$month-01")) . '</h3>';
            echo '<table class="table">';
            echo '<thead><tr><th>Name</th><th>Employee ID</th><th>Days Present</th></tr></thead>';
            echo '<tbody>';

            foreach ($employees as $employeeId => $data) {
                // Placeholder calculation logic for demo purposes
                $daysPresent = $data['DaysPresent']; // You should replace this with actual monthly calculation logic
                echo '<tr>';
                echo '<td>' . htmlspecialchars($data['FullName']) . '</td>';
                echo '<td>' . htmlspecialchars($employeeId) . '</td>';
                echo '<td>' . htmlspecialchars($daysPresent) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
        ?>
    </div>
</div>

<?php include('footer.php'); ?>
