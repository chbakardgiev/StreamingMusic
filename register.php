<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name = "audiolibdb"; // Database name 
$tbl_name = "members"; // Table name 

// Connect to server and select databse.
$conn = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($conn,"$db_name")or die("cannot select DB");
// generating salt
$salt = mcrypt_create_iv(7);
$salt = hash("sha256",$salt);
session_start();
//if($_POST['myusername']==NULL||$_POST['mypassword']==NULL){
//    header("location:register.html");
//}
$myusername = filter_input(INPUT_POST, 'myusername');
$mypassword = filter_input(INPUT_POST, 'mypassword');
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($conn,$myusername);
$mypassword = mysqli_real_escape_string($conn,$mypassword);
// username and password sent from form 
$mypassword = hash("sha256",$mypassword);
$query = mysqli_query($conn,"SELECT * FROM $tbl_name");
$numOfRowsBefore = mysqli_num_rows($query);
$insert = "INSERT INTO `audiolibdb`.`members` (`id`, `username`, `password`, `salt`) "
        . "VALUES (NULL, '$myusername', '$mypassword', '$salt');";
$result = mysqli_query($conn,$insert);
//$saltedpass = hash("sha256",$_POST['mypassword']).$salting;
$numOfRowsAfter = mysqli_num_rows("SELECT * FROM $tbl_name");
// If result matched $myusername and $mypassword, table row must be 1 row
if($numOfRowsAfter!=$numOfRowsBefore){
session_start();
// Register $myusername, $mypassword and redirect to file "server.php"
$_SESSION["myusername"] = $myusername;
$_SESSION["mypassword"] = $mypassword; 
header("location:server.php");
}
else {
echo "Couldn't register! :(";
}
?>