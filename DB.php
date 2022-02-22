<?php
$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="E_attendance"; // Database name
$con=mysqli_connect("$host", "$username", "$password","$db_name") or die("Error in connection");
mysqli_query($con,"set names 'utf8'");
?>