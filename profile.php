<?php include('header.php'); ?>
<?php
include_once('controller/connect.php');
$dbs = new database();
$db = $dbs->connection();

// Initialize variables
$row = [];

// Ensure the session variable is set
if (isset($_SESSION['User']['id'])) {
    $ProfileEmpId = $_SESSION['User']['id'];

    // Fetch email and password from admin_data table
    $view = mysqli_query($db, "SELECT Email, Password FROM admin_data WHERE id='$ProfileEmpId'");
    $row = mysqli_fetch_assoc($view);
}

// Handle form submission
if (isset($_POST['close'])) {
    echo "<script>window.location='home.php';</script>";
}
?>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').basictable();
    });
</script>
    <style>
    .breadcrumb {
        background-color: lavender; /* Lavender background */
        padding: 10px; /* Padding around the breadcrumb */
        border-radius: 5px; /* Slight rounding of the corners */
        font-size: 16px; /* Adjust font size */
        margin: 10px 0px !important; /* Space above and below the breadcrumb */
    }
    
    .breadcrumb-item {
        display: inline-block;
        color: #4b0082; /* Darker indigo color for text */
        text-decoration: none; /* Remove underline from links */
        font-weight: bold;
        margin-right: 10px; /* Space between breadcrumb items */
    }

    .breadcrumb-item a {
        color: #4b0082; /* Indigo for links */
        text-decoration: none; /* Remove underline from the links */
    }
    
    .breadcrumb-item a:hover {
        color: #6a5acd; /* Slightly lighter indigo color on hover */
    }

    .fa-angle-right {
        color: #4b0082; /* Indigo color for arrow icon */
        margin-left: 5px;
        margin-right: 5px;
    }


</style>
<ol class="breadcrumb" style="margin: 10px 0px !important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Profile</li>
</ol>
<form method="post">
<div class="validation-form" style="margin-top: 0;">
    <h2 style="text-transform: capitalize; margin: 0px;">
        Profile Details
    </h2>
    <div class="profile-container">
        <div class="profile-card">
            <div class="content">
                <h3>Email & Password</h3>
                <p><b>Email:</b> <?php echo !empty($row['Email']) ? $row['Email'] : 'Not Available'; ?></p>
                <p><b>Password:</b> <?php echo !empty($row['Password']) ? $row['Password'] : 'Not Available'; ?></p>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row" style="text-align: center; margin-top: 2%;">
        <div class="col-md-12 form-group">
            <button type="submit" name="close" class="btn btn-primary" style="  background-color: slateblue; color:white; :hover{ background-color: darkturquoise;}    ">Close</button>
        </div>
    </div>
</div>
</form>

<?php include('footer.php'); ?>
