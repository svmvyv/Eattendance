<?php 
include "../DB.php"; 
$SectionID=$_POST['SectionID'];
$userid=$_POST['userid'];
$sql = "select *,sectionlecture.SectionLecID from sectionlecture inner join coursesection on sectionlecture.SectionID=coursesection.SectionID inner join courses on courses.CourseID=coursesection.CourseID inner join lecattendance on lecattendance.SectionLecID=sectionlecture.SectionLecID  where coursesection.SectionID='$SectionID' and  lecattendance.UserID='$userid' order by sectionlecture.SectionLecID desc" ;
$rs = mysqli_query($con,$sql);
if (mysqli_num_rows($rs) > 0) {
    $response["arr"] = array();
while($row = mysqli_fetch_array($rs))
{    
$saturday='';
$Sunday='';
$Monday='';
$Tuseday='';
$Wensday='';
$Thursday='';
$friday='';          
    $cat = array(); 
    $cat["CourseName"] = $row["CourseName"];
    $cat["SectionName"] = $row["SectionName"];
    $cat["StartTime"] = $row["StartTime"];
    $cat["EndTime"] = $row["EndTime"];
    $cat["Status"] =  $row["Status"];
    $statusdesc="";
    if($row['Status']==0)
    $statusdesc= 'Absent';
    else
    $statusdesc= 'attending';
    $cat["statusdesc"] =  $row["statusdesc"];
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