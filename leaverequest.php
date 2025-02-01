<?php include('header.php');?>
<?php
  include_once('controller/connect.php');
  
  $dbs = new database();
  $db=$dbs->connection();
  $Statusl = "Pending";
  $leavedetails = mysqli_query($db,"select * from leavedetails where LeaveStatus='$Statusl'");
  if(isset($_GET['id']))
  {
    $acceptid = $_GET['id'];
    $accept = "Accept";
    mysqli_query($db,"update leavedetails set LeaveStatus='$accept' where Detail_Id='$acceptid'");
    echo "<script>window.location='leaverequest.php';</script>";
  }
  else if(isset($_GET['msg']))
  {
    $deniedid = $_GET['msg'];
    $denied = "Denied";
    mysqli_query($db,"update leavedetails set LeaveStatus='$denied' where Detail_Id='$deniedid'");
    echo "<script>window.location='leaverequest.php';</script>";
  }

  $laccept = mysqli_query($db,"SELECT l.*,e.FirstName,e.LastName,lt.Type_of_Name FROM leavedetails l JOIN employee e ON l.EmpId=e.EmployeeId JOIN type_of_leave lt on l.TypesLeaveId=lt.LeaveId WHERE LeaveStatus='Accept'");
  $ldenied = mysqli_query($db,"SELECT l.*,e.FirstName,e.LastName,lt.Type_of_Name FROM leavedetails l JOIN employee e ON l.EmpId=e.EmployeeId JOIN type_of_leave lt on l.TypesLeaveId=lt.LeaveId WHERE LeaveStatus='Denied'");
  
?>

<head>
  <!-- Add Bootstrap CSS -->
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  -->
<!-- Add Font Awesome for icons -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> -->
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
   
</head>
<!-- html code-->
 <body>
<ol class="breadcrumb" style="margin: 10px 0px ! important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Leave<i class="fa fa-angle-right"></i>Leave</li>
</ol>
<form method="POST">
<div class="scrollable-container">
<div class="validation-form" style="padding: 20px; background: #f9f9f9; border-radius: 8px;">

    <h2 style="color: light grey; text-align: center;"><b>Request Leave</b></h2>
    <div class="row" style="color: white; margin-right: 0; margin-left: 0; background-color: #004085; padding: 10px; border-radius: 4px;">
        <div style=" text-align: center;" class="col-md-1 control-label">
            <h5 style="margin: 0; color: white;">ID</h5>
        </div>
        <div style=" text-align: center;  font-weight: bold;" class="col-md-2 control-label">
            <h5 style="margin: 0; color: white;">Name</h5>
        </div>
        <div style=" text-align: center; font-weight: bold;" class="col-md-1 control-label">
            <h5 style="margin: 0; color: white;">Emp ID</h5>
        </div>
        <div style=" font-weight: bold; text-align: center;" class="col-md-2 ">
            <h5 style="margin: 0; color: white;">Leave Status</h5>
        </div>
        <div style=" text-align: center;font-weight: bold;" class="col-md-1 control-label">
            <h5 style="margin: 0; color: white;">Reason</h5>
        </div>
        <div style="text-align: center;font-weight: bold;" class="col-md-2 control-label">
            <h5 style="margin: 0; color: white;">Start Date</h5>
        </div>
        <div style=" text-align: center;font-weight: bold;" class="col-md-2 control-label">
            <h5 style="margin: 0; color: white;">End Date</h5>
        </div>
        <div style="text-align: center;font-weight: bold;" class="col-md-1 control-label">
            <h5 style="margin: 0;color: white;">Action</h5>
        </div>
    </div>

    <?php $i=1; while($row = mysqli_fetch_assoc($leavedetails)) {
        $empid = $row['EmpId'];
        $name = mysqli_query($db, "select * from employee where EmployeeId='$empid'");
        $empname = mysqli_fetch_assoc($name);
        $namem = ucfirst($empname['FirstName']) . " " . ucfirst($empname['LastName']);
        $typen = $row['TypesLeaveId'];
        $typeid = mysqli_query($db, "select * from type_of_leave where LeaveId='$typen'");
        $typename = mysqli_fetch_assoc($typeid);
    ?>
    <div class="row" style="margin-right: 0; margin-left: 0; padding: 10px; background-color: #fff; border-radius: 4px; margin-top: 10px;">
        <div class="col-md-1" style="text-align: center;"><?php echo $i; $i++; ?></div>
        <div class="col-md-2" style="text-align: center;"><?php echo (isset($namem)) ? $namem : ""; ?></div>
        <div class="col-md-1" style="text-align: center;"><?php echo (isset($row['EmpId'])) ? $row['EmpId'] : ""; ?></div>
        <div class="col-md-2" style="text-align: center;"><?php echo ucfirst((isset($typename['Type_of_Name'])) ? $typename['Type_of_Name'] : ""); ?></div>
        <div class="col-md-1" style="text-align: center;"><?php echo ucfirst((isset($row['Reason'])) ? $row['Reason'] : ""); ?></div>
        <div class="col-md-2" style="text-align: center;"><?php echo (isset($row['StateDate'])) ? $row['StateDate'] : ""; ?></div>
        <div class="col-md-2" style="text-align: center;"><?php echo (isset($row['EndDate'])) ? $row['EndDate'] : ""; ?></div>
        <div class="col-md-1" style="text-align: center;">
            <a href="?id=<?php echo $row['Detail_Id'];?>" title="Accept" style="color: #28a745; font-size: 18px;">
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            </a>&nbsp;&nbsp;
            <a href="?msg=<?php echo $row['Detail_Id'];?>" title="Denied" style="color: #dc3545; font-size: 18px;">
                <i class="fa fa-thumbs-down" aria-hidden="true"></i>
            </a>
        </div>
    </div>
    <hr style="margin-bottom: 0px; margin-top: 0px; border-top: 1px solid #ddd;">
    <?php } ?>
</div>


<div class="validation-form" style="margin-bottom: 0px;margin-top: 10px;">
<h2><center>Accepted Leave</center></h2>
<div class="row" style="color: white; margin-right: 0; margin-left: 0; background-color: #004085; padding: 10px; border-radius: 4px;">
  
<div class="col-md-1" style="text-align: center; font-weight: bold;">
    <h5 style="margin: 0; color: white;">ID</h5>
  </div>
  <div class="col-md-4" style="text-align: center; font-weight: bold;">
    <h5  style="margin: 0; color: white;" >Name</h5>
  </div>
  <div class="col-md-3" style="text-align: center; font-weight: bold;">
    <h5  style="margin: 0; color: white;">Leave Type</h5>
  </div>
  <div class="col-md-2" style="text-align: center; font-weight: bold;">
    <h5  style="margin: 0; color: white;">Start Date</h5>
  </div>
  <div class="col-md-2" style="text-align: center; font-weight: bold;">
    <h5  style="margin: 0; color: white;">End Date</h5>
  </div>
</div>

    <?php $i=1; while($row = mysqli_fetch_assoc($laccept)) { 
      $name = ucfirst($row['FirstName']." ".$row['LastName']);
      ?>
<div class="row" style="margin-right: 0; margin-left: 0;">
  <div style="text-align: center;"class="col-md-1">
    <h5><?php $i=$i; echo $i; $i++;?></h5>
  </div>
  <div style="text-align: center;" class="col-md-4">
    <h5><?php echo(isset($name))?$name:"";?></h5>
  </div>
  <div style="text-align: center;"class="col-md-3">
    <h5><?php echo(isset($row['Type_of_Name']))?$row['Type_of_Name']:"";?></h5>
  </div>
  <div style="text-align: center;"class="col-md-2">
    <h5><?php echo(isset($row['StateDate']))?$row['StateDate']:"";?></h5>
  </div>
  <div style="text-align: center;"class="col-md-2">
    <h5><?php echo(isset($row['EndDate']))?$row['EndDate']:"";?></h5>
  </div>
</div><hr style="margin-bottom: 0px;margin-top: 0px;border-top: 1px solid light grey;">
<?php } ?>
<div class="clearfix"></div>
</div>

<div class="validation-form" style="margin-bottom: 30px;margin-top: 10px;">
<h2><center>Denied Leave</center></h2>
<div class="row" style="color: white; margin-right: 0;  text-align: center; margin-left: 0; background-color: #004085; padding: 10px; border-radius: 4px;">
  <div class="col-md-1" style="text-align: center; font-weight: bold;">
    <h5  style="margin: 0; color: white;">ID</h5>
  </div>
  <div class="col-md-4" style="text-align: center; font-weight: bold;">
    <h5  style="margin: 0; color: white;">Name</h5>
  </div>
  <div class="col-md-3" style="text-align: center; font-weight: bold;">
    <h5  style="margin: 0; color: white; ">Leave Type</h5>
  </div>
  <div class="col-md-2" style="text-align: center; font-weight: bold;">
    <h5  style="margin: 0; color: white;">Start Date</h5>
  </div>
  <div class="col-md-2" style="text-align: center; font-weight: bold;">
    <h5  style="margin:0px; color: white;">End Date</h5>
  </div>
</div>

    <?php $i=1; while($row = mysqli_fetch_assoc($ldenied)) {
      $name = ucfirst($row['FirstName']." ".$row['LastName']);
      ?>
<div class="row" style="margin-right: 0; margin-left: 0;">
  <div style="text-align: center;"class="col-md-1">
    <h5><?php $i=$i; echo $i; $i++;?></h5>
  </div>
  <div style="text-align: center;"class="col-md-4">
    <h5><?php echo(isset($name))?$name:"";?></h5>
  </div>
  <div style="text-align: center;"class="col-md-3">
    <h5><?php echo(isset($row['Type_of_Name']))?$row['Type_of_Name']:"";?></h5>
  </div>
  <div style="text-align: center;"class="col-md-2">
    <h5><?php echo(isset($row['StateDate']))?$row['StateDate']:"";?></h5>
  </div>
  <div style="text-align: center;"class="col-md-2">
    <h5><?php echo(isset($row['EndDate']))?$row['EndDate']:"";?></h5>
  </div>
</div><hr style="margin-bottom: 0px;margin-top: 0px;border-top: 1px solid #eee;">
<?php } ?>
</div>
<div class="clearfix"></div>
</form>
    </div>
    </body>
<?php include('footer.php'); ?>

