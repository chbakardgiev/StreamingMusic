<!doctype html>
<html>
<head>
<meta charset="windows-1252">
<title>Music collection</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <input type="button" class="btn btn-default" value="Get back" style="background-color: greenyellow" onclick="document.location.href='musiccollection.php';">
    <input type="button" class="btn btn-default" value="Delete all!" style="background-color: red" id="delete" onclick="document.location.href='delete.php';">
<br>
</body>
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
foreach($_POST['Select'] as $genre)
{
    $r = mysqli_query($conn,"SELECT filename from $tbl_name where owner = '$myusername' and genre=$genre GROUP BY filename order by filename");
while($row = mysqli_fetch_array($r)) {
	echo '<a href="play.php?name='.$row['filename'].'">'.$row['filename'].'</a>';
	echo "<br>";
}
}
//else {
//    $genre = $_SESSION['genre'];
//    $r = mysqli_query($conn,"SELECT filename from audios where owner = '$myusername',where genre='$genre' GROUP BY filename order by filename");
//while($row = mysqli_fetch_array($r)) {
//	echo '<a href="play.php?name='.$row['filename'].'">'.$row['filename'].'</a>';
//	echo "<br>";
//}
//}
mysqli_close($conn);
?>
</html>