<?php include('header.php'); ?>

<?php
include_once('controller/connect.php');

$dbs = new database();
$db = $dbs->connection();

if (isset($_POST['submit'])) {
    $year = mysqli_real_escape_string($db, $_POST['year']);
    $month = mysqli_real_escape_string($db, $_POST['month']);
    $day = mysqli_real_escape_string($db, $_POST['day']);
    
    $query = "INSERT INTO working_data_of_emp (year, month, day) VALUES ('$year', '$month', '$day')";
    if (mysqli_query($db, $query)) {
        echo "<script>window.location='workingdayadd.php';</script>";
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
<style>
     body{
        background-color: white;
    }
</style>
<ol class="breadcrumb" style="margin: 10px 0px !important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Leave<i class="fa fa-angle-right"></i>Add Working Day</li>
</ol>
<hr>
<form method="POST">
    <div class="container-fluid" style="margin-bottom: 60px; margin-top: 10px;  background: white; margin-left:-10px;">
        <div class="row" style="margin-left: 200px;">
            <h2 style="color: #1abc9c; margin-left:80px; padding:10px;">Add Working Day</h2>
            
            <div class="col-md-3 control-label">
                <label class="control-label">Working Year</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-sun-o" aria-hidden="true"></i>
                    </span>
                    <input type="text" name="year" title="Year" autocomplete="off" maxlength="4" placeholder="Enter Year" required="" class="form-control" style="width: 250px; height: 36px;" onkeyup="this.value=this.value.replace(/\D/g,'')">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="margin-left: 200px;">
            <div class="col-md-3 control-label">
                <label class="control-label">Working Month</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-sun-o" aria-hidden="true"></i>
                    </span>
                    <input type="text" name="month" title="Month" autocomplete="off" maxlength="2" placeholder="Enter Month" required="" class="form-control" style="width: 250px; height: 36px;" onkeyup="this.value=this.value.replace(/\D/g,'')">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="margin-left: 200px;">
            <div class="col-md-3 control-label">
                <label class="control-label">Working Monthly Day</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-sun-o" aria-hidden="true"></i>
                    </span>
                    <input type="text" name="day" title="Day" autocomplete="off" maxlength="2" placeholder="Enter Day" required="" class="form-control" style="width: 250px; height: 35px;" onkeyup="this.value=this.value.replace(/\D/g,'')">
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="margin-left: 200px;">
            <div class="col-md-3 form-group">
                <button type="submit" name="submit" class="btn btn-primary" title="Add">Add</button>
                <button type="reset" class="btn btn-default" title="Reset">Reset</button>
            </div>
        </div>
    </div>
</form>

<?php include('footer.php'); ?>
