<?php 
include "../DB.php"; 
$lecid=$_POST['lecid'];
$userid=$_POST['userid'];
$deviceid=$_POST['deviceid'];
$sql="SELECT SectionLecID,Status FROM lecattendance where SectionLecID='$lecid' and UserID='$userid'"; 
$rs = mysqli_query($con,$sql);
if (mysqli_num_rows($rs) > 0) {
	$row = mysqli_fetch_array($rs);
	if($row['Status']==1){
		$response["success"] = 2;
	}
	else
	{
	$updatesql='update lecattendance set Status=1,DeviceMacAddress='$deviceid' where SectionLecID='$lecid' and UserID='$userid'';
	$result = mysql_query($query);
	$response["success"] = 1;
	}
}
else {
	$response["success"] = 0;
}
echo  json_encode($response);
?>