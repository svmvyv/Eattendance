<?php 
include "../DB.php"; 
$userid=$_POST['userid'];
$sql = "select * from courses inner join coursesection on courses.CourseID=coursesection.CourseID  inner join usersection on usersection.SectionID=coursesection.SectionID where UserID='$userid'" ;
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
                    if($row['Saturday']==1)
                      {
                      	$saturday=' Saturday';
                      }
                      if($row['Sunday']==1)
                      {
                      	$Sunday=' Sunday';
                      }
                      if($row['Monday']==1)
                      {
                      	$Monday=' Monday';
                      }
                      if($row['Tuseday']==1)
                      {
                      	$Tuseday=' Tuseday';
                      }
                      if($row['Wensday']==1)
                      {
                      	$Wensday=' Wensday';
                      }
                      if($row['Thursday']==1)
                      {
                      	$Thursday=' Thursday';
                      }

                     if($row['Friday']==1)
                      {
                      	$friday=' Friday';
                      }            
    $cat["sectiondays"] = $saturday . $Sunday . $Monday.$Tuseday.$Wensday.$Thursday.$friday;
    $cat["StartTime"] = $row["StartTime"];
    $cat["EndTime"] = $row["EndTime"];
    $cat["SectionID"] =  $row["SectionID"];
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