<?php 
include "DB.php"; 
if(isset($_POST['username']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$sql="SELECT * FROM users where Username='$myusername' and password='$mypassword'"; 
$rs = mysqli_query($con,$sql);
if (mysqli_num_rows($rs) > 0) {
    $row = mysqli_fetch_array($rs);
    $response["id"]=$row['UserID'];
    $response["fullname"]=$row['FullName'];
    $response["TypeID"]=$row['TypeID'];
    $response["found"] = 1;    
}
else{
    $response["found"] = 0;
}
 header('Content-Type: application/json; charset=utf8');
 echo json_encode($response);
}
?>