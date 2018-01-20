<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name = "audiolibdb"; // Database name 
$tbl_name = "members"; // Table name 

// Connect to server and select databse.
$conn = mysqli_connect('localhost','root','','audiolibdb');
mysqli_select_db($conn,"$db_name")or die("cannot select DB");
// generating salt

// username and password sent from form 
$myusername = filter_input(INPUT_POST,'myusername'); 
$salt = "SELECT salt FROM $tbl_name WHERE username=$myusername";
$salting = mysqli_query($conn,$salt);
$saltedpass = hash("sha256",filter_input(INPUT_POST,'mypassword')).$salting;
$mypassword = $saltedpass; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($conn,$myusername);
$mypassword = mysqli_real_escape_string($conn,$mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysqli_query($conn,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
session_start();
// Register $myusername, $mypassword and redirect to file "server.php"
$_SESSION["myusername"] = $myusername;
$_SESSION["mypassword"] = $mypassword; 
header("location:server.php");
}
else {
echo "Wrong Username or Password";
}
mysqli_close($conn);