<!doctype html>
<html>
<head>
<meta charset="windows-1252">
<title>Music collection</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <input type="button" class="btn btn-default" style="background-color: red" value="Get back" onclick="document.location.href='musiccollection.php';">
<br>
</body>
</html>
<?php
session_start();
if(!isset($_SESSION['myusername'])&&!isset($_SESSION['mypassword'])){
header("location:design.html");
}
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name = "audiolibdb"; // Database name 
$tbl_name = "audios"; // Table name 
$myusername = $_SESSION["myusername"];
$conn = mysqli_connect("$host", "$username", "$password"); 
mysqli_select_db($conn,"$db_name")or die("cannot select DB");
$sql = "delete from $tbl_name where owner='$myusername'";
$result = mysqli_query($conn,$sql);
$files = glob('uploads/'.$myusername.'/*'); // get all file names
echo "Everything is deleted";
foreach($files as $file){ // iterate files
  if(is_file($file)){
    unlink($file); // delete file
}
}
mysqli_close($conn);