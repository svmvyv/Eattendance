<?php 
include "../DB.php"; 
date_default_timezone_set('Asia/Riyadh');
$date = date("Y-m-d");
$today = date('l', strtotime($date));
$time=strtotime(date("G:i:s"));
$userid=$_POST['userid'];
$sql = "select * from courses inner join coursesection on courses.CourseID=coursesection.CourseID  inner join usersection on usersection.SectionID=coursesection.SectionID where coursesection.DOCID='$userid'" ;
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
$starttime=strtotime($row['StartTime']);
$sec_length=13;
$limitedtime= strtotime("+$sec_length minutes", $starttime);
$endtime=strtotime($row['EndTime']);            
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
    //can attend
    $canattand=0
    if($row['Saturday']==1 and $today=="Saturday" and $time > $starttime and $time < $limitedtime )
                      {
                      $canattand=1 ;
                      }
                      else if($row['Sunday']==1 and $today=="Sunday" and $time > $starttime and $time <$limitedtime)
                      {
                        $canattand=1 ;
                      }
                      else if($row['Monday']==1 and $today=="Monday" and $time > $starttime and $time <$limitedtime)
                      {
                        $canattand=1 ;
                      }
                      else if($row['Tuseday']==1 and $today=="Tuesday" and $time > $starttime and $time <$limitedtime)
                      {
                        $canattand=1 ;
                      }
                      else if($row['Wensday']==1 and $today=="Wednesday" and $time > $starttime and $time <$limitedtime)
                      {
                      
                        $canattand=1 ;
                      }
                     else if($row['Thursday']==1 and $today=="Thursday" and $time > $starttime and $time <$limitedtime)
                      {
                        $canattand=1 ;
                      }

                      else if($row['Friday']==1 and $today=="Friday" and $time > $starttime and $time <$limitedtime)
                      {
                        $canattand=1 ;
                      }
                      
    
    $cat["canattand"] = $canattand;
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