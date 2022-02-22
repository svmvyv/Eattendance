<?php 
include "../DB.php"; 
$sectionid=$_POST['sectionid'];
$seclecid=0;
$today= date("Y-m-d");
$query1="select SectionLecID from sectionlecture where SectionID='$sectionid' and LECDate='$today'";
$result2=mysql_query($query1);
$count=mysql_num_rows($result2);
$row1 = mysql_fetch_array($result2);
if ($count==1)
{
$seclecid=$row1['SectionLecID'];
$response['SectionLecID']=$row1['SectionLecID'];
$response['attendimage']=$row1['QRCodeImage'];
}
else
{
$query="INSERT INTO sectionlecture (SectionID,LECDate) values('$sectionid','$today')";
mysql_query($query);
$seclecid=mysql_insert_id();
$QRimageurl="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".$seclecid."&choe=UTF-8"
//create qrcodeimage with sectionlecid and update table
$response['SectionLecID']=$seclecid;
$response['attendimageurl']=$QRimageurl;
$updateLEC="update sectionlecture set QRCodeImage='$QRimageurl' where SectionLecID='$seclecid'";
$result = mysql_query($updateLEC);
$sql="SELECT users.userid FROM users inner join usersection on users.userid=usersection.userid where usersection.SectionID='$sectionid' and users.TypeID=2";
$result1=mysql_query($sql);
while($rows=mysql_fetch_array($result1)){
	$userid=$rows['userid'];
	$query = "INSERT INTO lecattendance (SectionLecID,UserID)
VALUES( '$seclecid','$userid')";
$result = mysql_query($query);	
}
}
echo  json_encode($response);
?>