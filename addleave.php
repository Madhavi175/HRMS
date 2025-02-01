<?php include('header.php');?>
<?php
  include_once('controller/connect.php');
  
  $dbs = new database();
  $db=$dbs->connection();

  $empid = $_SESSION['User']['id'];
  $sql = mysqli_query($db,"select * from type_of_leave ");
  $leavedetails = mysqli_query($db,"select * from leavedetails where EmpId='$empid' ");

  if(isset($_POST['Apply']))
  {
    $leave = $_POST['leavestatus'];
    $reason = $_POST['reason'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $leavestatus = "Pending";
    /*date formate*/
    $date = str_replace('/', '-', $startdate);
    $startd = date('Y-m-d', strtotime($date));
    $datee = str_replace('/', '-', $enddate);
    $endd = date('Y-m-d', strtotime($datee));
    /*end date formate*/

    mysqli_query($db,"insert into leavedetails values(null,'$empid','$leave','$reason','$startd','$endd','$leavestatus')");
    echo "<script>window.location='addleave.php';</script>";
  }

   ?>

 <style>.scrollable-container {
        max-height: 500px;
        overflow-y: auto;
        padding: 10px;
        background: #fff;
        border-radius: 4px;
        border: 1px solid #ddd;
        margin-top: 10px;
    }
    body{
        background-color: white;
    }
    
    </style>



<ol class="breadcrumb" style="margin: 10px 0px ! important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Leave<i class="fa fa-angle-right"></i>Add Leave</li>
</ol>
<form method="POST">
<div class="scrollable-container"> 
<div class="container-fluid" style="margin-bottom: 30px;margin-top: 10px; background: white;">
	<div class="row">
		<h2 style="color: #1abc9c;"><center><b>Apply Leave</b></center></h2><hr>
		<div class="col-md-5 control-label">
        <label class="control-label">Type Leave</label>
        <div class="input-group">             
            <span class="input-group-addon">
            <i class="fa fa-sun-o" aria-hidden="true"></i>
            </span>
           	<select name="leavestatus" title="Select Leave" style="text-transform: capitalize; " required>
           	<option value="">-- Select leave --</option>
            <?php while($row = mysqli_fetch_assoc($sql)) { ?>
            <option value="<?php echo $row['LeaveId']; ?>"><?php echo $row['Type_of_Name'];?></option>
            <?php } ?>
            </select>
        </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="row">
        <div class="col-md-5 control-label">
              <label class="control-label">Reason</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
              </span>
              <input type="text" name="reason" class="form-control" required="">
              </div>
            </div>
        <div class="clearfix"> </div>
    </div>
    <div class="row">
        <div class="col-md-5 control-label">
              <label class="control-label">Start Date</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-calendar" aria-hidden="true"></i>
              </span>
              <input type="text" id="StartDate" title="Select First Date" name="startdate" class="form-control" required="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
              </div>
            </div>
        <div class="clearfix"> </div>
    </div>

    <div class="row">
        <div class="col-md-5 control-label">
            <label class="control-label">End Date</label>
            <div class="input-group">             
                <span class="input-group-addon">
        	    	<i class="fa fa-calendar" aria-hidden="true"></i>
            	</span>
              	<input type="text" id="EndDate" name="enddate" title="Select End Date" class="form-control" required="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>

    <div class="row">
    	<div class="col-md-3 form-group">
        	<button type="submit" name="Apply" title="Apply" class="btn btn-primary">Apply</button>
            <button type="reset" class="btn btn-default" title="Reset">Reset</button>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>



<div class="validation-form" style="margin-bottom: 30px; margin-top: -10px; background: white;">
    <h2><b><center>View Leave</center></b></h2>
    <div class="table-responsive" style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;" class="table table-bordered table-striped">
            <thead style="background-color: #343a40; color: white;">
                <tr>
                    <th style=" font-size:17px; padding: 10px; text-align: center; color:darkturquoise; border-bottom: 4px solid #1abc9c; font-weight: bold;">ID</th>
                    <th style=" font-size:17px; padding: 10px; text-align: center; color:darkturquoise;border-bottom: 4px solid #1abc9c; font-weight: bold;">Leave Status</th>
                    <th style=" font-size:17px; padding: 10px; text-align: center; color:darkturquoise;border-bottom: 4px solid #1abc9c; font-weight: bold;">Reason</th>
                    <th style=" font-size:17px; padding: 10px; text-align: center; color:darkturquoise;border-bottom: 4px solid #1abc9c; font-weight: bold;">Start Date</th>
                    <th style=" font-size:17px; padding: 10px; text-align: center; color:darkturquoise;border-bottom: 4px solid #1abc9c; font-weight: bold;">End Date</th>
                    <th style=" font-size:17px; padding: 10px; text-align: center; color:darkturquoise;border-bottom: 4px solid #1abc9c; font-weight: bold;">Status</th>
                    <th style=" font-size:17px; padding: 10px; text-align: center; color:darkturquoise;border-bottom: 4px solid #1abc9c; font-weight: bold;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; while($rom = mysqli_fetch_assoc($leavedetails)) {
                    $typeid = $rom['TypesLeaveId'];
                    $typename = mysqli_query($db,"select * from type_of_leave where LeaveId='$typeid' ");
                    $typen = mysqli_fetch_assoc($typename); ?> 
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style=" color:light grey; padding: 10px; text-align: center; border: 0px solid #dee2e6;font-weight:bold;"><?php echo $i; $i++; ?></td>
                    <td style="   color:light grey;  padding: 10px; text-align: center; border: 0px solid #dee2e6;font-weight:bold;"><?php echo ucfirst((isset($typen['Type_of_Name']))?$typen['Type_of_Name']:""); ?></td>
                    <td style="        color:light grey; padding: 10px; text-align: center;font-weight:bold; border: 0px solid #dee2e6;"><?php echo(isset($rom['Reason']))?$rom['Reason']:""; ?></td>
                    <td style=" color:light grey; padding: 10px; text-align: center; font-weight:bold;border: 0px solid #dee2e6;"><?php echo(isset($rom['StateDate']))?$rom['StateDate']:""; ?></td>
                    <td style="padding: 10px;  color:light grey;  text-align: center; border: 0px solid #dee2e6;font-weight:bold;"><?php echo(isset($rom['EndDate']))?$rom['EndDate']:""; ?></td>
                    <td style="padding: 10px; text-align: center; color:light grey; color:light grey;font-weight:bold; border: 0px solid #dee2e6;"><?php echo(isset($rom['LeaveStatus']))?$rom['LeaveStatus']:""; ?></td>
                    <td class="text-center" style="padding: 10px; text-align: center; color:light grey; font-weight:bold;">
                        <?php if($rom['LeaveStatus'] == "Pending") {?>
                            <a onclick="history.go(0)" title="Refresh" style="color: #050100;"><i class="la fa fa-refresh" aria-hidden="true"></i></a>
                        <?php } else if($rom['LeaveStatus'] == "Accept"){ ?>
                            <a title="Accept"><i class="fa fa-check" aria-hidden="true"></i></a>
                        <?php } else { ?>
                            <a title="Denied" style="color:#E83114;"><i class="fa fa-times" aria-hidden="true"></i></a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



</form>
<!--Font Awesome spin icon it code-->
        <script>
          $(".la").mouseover(function (e) 
          {
            $(this).removeClass('fa fa-refresh')
            $(this).addClass('fa fa-refresh fa-spin')
          }).mouseout(function (e)
          {
            $(this).removeClass('fa fa-refresh fa-spin')
            $(this).addClass('fa fa-refresh')
          })
        </script>
        <!--Font Awesome code End-->
<?php include('footer.php'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#StartDate", {
      dateFormat: "d/m/Y",
      minDate: "01/01/2015",
      maxDate: "01/01/2030",
      locale: {
        firstDayOfWeek: 1 // Start week on Monday
      }
    });

    flatpickr("#EndDate", {
      dateFormat: "d/m/Y",
      minDate: "01/01/2015",
      maxDate: "01/01/2030",
      locale: {
        firstDayOfWeek: 1 // Start week on Monday
      }
    });
  });
</script>

