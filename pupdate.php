

<?php
if(isset($_POST['sub']))
{
$con=mysqli_connect("localhost","root","") ;
    mysqli_select_db("hr");
echo $pid=$_POST['pid1'];
echo $pname=$_POST['pname'];
echo $pmgr=$_POST['pmgr'];
echo $ploc=$_POST['ploc'];
$s="update project set pname='".$pname."',pmgr='".$pmgr."',plocation='".$ploc."' where pid=".$pid;
mysqli_query($s);
header("location:viewproject.php");
    }
?>