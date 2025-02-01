<?php
include('header.php');
include_once('controller/connect.php');

$dbs = new database();
$db = $dbs->connection();
$row = [];
$gendern = [];
$maritaln = [];
$cityn = [];
$staten = [];
$countryn = [];
$positionn = [];
$rolen = [];

if (isset($_GET['EmployeeId'])) {
    $empid = $_GET['EmployeeId'];

    // Fetch employee data
    $view = mysqli_query($db, "SELECT * FROM employees_data WHERE EmployeeId='$empid'");
    $row = mysqli_fetch_assoc($view);

    if ($row) {
        $genderid = $row['Gender'];
        $gid = mysqli_query($db, "SELECT * FROM employees_data WHERE Gender='$genderid'");
        $gendern = mysqli_fetch_assoc($gid);

        $maritalid = $row['MaritalStatus'];
        $mid = mysqli_query($db, "SELECT * FROM employees_data WHERE MaritalStatus='$maritalid'");
        $maritaln = mysqli_fetch_assoc($mid);

        $cityid = $row['City'];
        $cid = mysqli_query($db, "SELECT * FROM employees_data WHERE City='$cityid'");
        $cityn = mysqli_fetch_assoc($cid);

        if ($cityn) {
            $stateid = $cityn['State'];
            $sid = mysqli_query($db, "SELECT * FROM employees_data WHERE State='$stateid'");
            $staten = mysqli_fetch_assoc($sid);
        }

        // $countryid = $staten['Country'];
        // $couid = mysqli_query($db, "SELECT * FROM employees_data WHERE Country='$countryid'");
        // $countryn = mysqli_fetch_assoc($couid);

        $positionid = $row['PositionId'];
        $pid = mysqli_query($db, "SELECT * FROM employees_data WHERE PositionId='$positionid'");
        $positionn = mysqli_fetch_assoc($pid);

        $roleid = $row['RoleId'];
        $rid = mysqli_query($db, "SELECT * FROM employees_data WHERE RoleId='$roleid'");
        $rolen = mysqli_fetch_assoc($rid);
    }
}

if (isset($_POST['close'])) {
    echo "<script>window.location='employeeview.php';</script>";
} elseif (isset($_POST['delete'])) {
    echo "<script>window.location='employeeview.php?empid=$empid';</script>";
} elseif (isset($_POST['edit'])) {
    echo "<script>window.location='editemployee.php?EmployeeId=$empid';</script>";
}
?>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#table').basictable();
  $('#table-breakpoint').basictable({ breakpoint: 768 });
  $('#table-swap-axis').basictable({ swapAxis: true });
  $('#table-force-off').basictable({ forceResponsive: false });
  $('#table-no-resize').basictable({ noResize: true });
  $('#table-two-axis').basictable();
  $('#table-max-height').basictable({ tableWrapper: true });
});
</script>
<ol class="breadcrumb" style="margin: 10px 0px ! important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Tables<i class="fa fa-angle-right"></i>Employee View<i class="fa fa-angle-right"></i>Detail View</li>
</ol>
<form method="post">
<div class="validation-form" style="margin-top: 0;">
    <h2 style="text-transform: capitalize; margin: 0px;">
        <?php echo isset($row) ? ($row['FirstName'] . " " . $row['MiddleName'] . " " . $row['LastName']) : "Null"; ?> - 
        <font color="black"><?php echo isset($row['EmployeeId']) ? "Employee ID :: " . $row['EmployeeId'] : "<b>Employee ID</b> :: Null"; ?></font>
    </h2>
    <div class="row">
        <div class="col-md-5">
            <table>
                <tbody>
                    <tr>
                        <td rowspan="2" style="text-align: right;"><b>Photo</b>&nbsp; ::</td>
                        <td rowspan="2"><img src="uploads/<?php echo isset($row['ProfileImage']) ? $row['ProfileImage'] : 'Null'; ?>" style="height: 61px; border: double;"></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Address</b> &nbsp;::</td>
                        <td><?php echo isset($row['Address1']) ? $row['Address1'] : 'Null'; ?>,</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?php echo isset($row['Address2']) ? $row['Address2'] : 'Null'; ?>, <?php echo isset($row['Address3']) ? $row['Address3'] : 'Null'; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?php echo isset($cityn['City']) ? ucfirst($cityn['City']) : 'Null'; ?>, <?php echo isset($staten['State']) ? ucfirst($staten['State']) : 'Null'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Gender</b> ::</td>
                        <td><?php echo isset($gendern['Gender']) ? ucfirst($gendern['Gender']) : 'Null'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Marital</b> ::</td>
                        <td><?php echo isset($maritaln['MaritalStatus']) ? $maritaln['MaritalStatus'] : 'Null'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Birth Date</b> ::</td>
                        <td><?php echo isset($row['Birthdate']) ? $row['Birthdate'] : 'Null'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Email</b> ::</td>
                        <td><?php echo isset($row['Email']) ? $row['Email'] : 'Null'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Mobile</b> ::</td>
                        <td><?php echo isset($row['Mobile']) ? $row['Mobile'] : 'Null'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Role</b> ::</td>
                        <td><?php echo isset($rolen['RoleId']) ? ucfirst($rolen['RoleId']) : 'Null'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Position</b> ::</td>
                        <td><?php echo isset($positionn['PositionId']) ? $positionn['PositionId'] : 'Null'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Join Date</b> ::</td>
                        <td><?php echo isset($row['JoinDate']) ? $row['JoinDate'] : 'Null'; ?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td style="text-align: right;"><b>Salary</b> ::</td>
                        <td><?php echo isset($row['Salary']) ? $row['Salary'] : 'Null'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row" style="text-align: center; margin-top: 2%;">
        <div class="col-md-12 form-group">
            <button type="submit" name="edit" class="btn btn-primary">Edit</button>
            <button type="submit" name="delete" class="btn btn-default">Delete</button>
            <button type="submit" name="close" class="btn btn-primary">Close</button>
        </div>
    </div>
</div>
</form>
<?php include('footer.php'); ?>
