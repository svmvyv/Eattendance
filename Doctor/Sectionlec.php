<?php 
include "../DB.php"; 
$secid=$_POST['secid'];
$sql = "select * from sectionlecture inner join coursesection on sectionlecture.SectionID=coursesection.SectionID inner join courses on courses.CourseID=coursesection.CourseID  where coursesection.SectionID='$secid' order by sectionlecture.SectionLecID desc" ;
$rs = mysqli_query($con,$sql);
if (mysqli_num_rows($rs) > 0) {
    $response["arr"] = array();
while($row = mysqli_fetch_array($rs))
{    

    $cat = array(); 
    $cat["CourseName"] = $row["CourseName"];
    $cat["SectionName"] = $row["SectionName"];
    $cat["LECDate"] = $row["LECDate"];
    $cat["StartTime"] = $row["StartTime"];
    $cat["EndTime"] = $row["EndTime"];
    $cat["NoOFAttendance"] = $row["NoOFAttendance"];
    $cat["NoOFAbsence"] = $row["NoOFAbsence"];
    $cat["SectionLecID"] = $row["SectionLecID"];
    array_push($response["arr"],$cat);                 
}
$response["success"] = 1;
}
else
{
    $response["success"] = 0;
    $response["message"] = "No any  sections";
}
echo  json_encode($response);
?>