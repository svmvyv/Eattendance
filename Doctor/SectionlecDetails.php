<?php 
include "../DB.php"; 
$lecid=$_POST['lecid'];
$sql = "SELECT *,users.userid,lecattendance.Status FROM users  inner join lecattendance on lecattendance.userid=users.userid inner join sectionlecture  on lecattendance.SectionLecID=sectionlecture.SectionLecID where sectionlecture.SectionLecID='$lecid'" ;
$rs = mysqli_query($con,$sql);
if (mysqli_num_rows($rs) > 0) {
    $response["arr"] = array();
while($row = mysqli_fetch_array($rs))
{    
    $cat = array(); 
    $cat["Username"] = $row["Username"];
    $cat["FullName"] = $row["FullName"];
    $cat["Status"] = $row["Status"];
    array_push($response["arr"],$cat);                 
}
$response["success"] = 1;
}
else
{
    $response["success"] = 0;
    $response["message"] = "No any Abscence Data";
}
echo  json_encode($response);
?>