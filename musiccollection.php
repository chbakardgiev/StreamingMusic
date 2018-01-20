<!doctype html>
<html>
<head>
<meta charset="windows-1252">
<title>Music collection</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
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
$conn = mysqli_connect('localhost','root','','audiolibdb');
mysqli_select_db($conn,"$db_name")or die("cannot select DB");
$genreQuery = "SELECT filename from $tbl_name where owner = '$myusername' GROUP BY filename";
$r = mysqli_query($conn,$genreQuery);
?>
<body>
    <form action="orderedcollection.php" method="POST">
    <div style="float: top">
    <input type="submit" value="Filter&Order" style="margin-left: 2px" class="btn btn-default" id="library">
     <label>filter by genre</label>
            <select name="Select[]" >
                <?php
$conn = mysqli_connect("localhost", "root", "");
mysqli_select_db($conn, "audiolibdb");
$result = mysqli_query($conn, "Select * from genre");
while ( $row = mysqli_fetch_array($result)) 
        { ?>
                <option  value="<?php echo $row['id']; ?> "><?php echo $row['name']; ?></option>
  <?php } 
  ?>
</select>
    </div>
    </form>
    <div style="float: bottom">
        <br>
<input type="button" value="Get back" style="background-color: greenyellow" class="btn btn-default" onclick="document.location.href='server.php';">
<input type="button" value="Delete all!" style="background-color: red" class="btn btn-default" id="delete" onclick="document.location.href='delete.php';">
    </div>
<?php
echo "<br>";
while($row = mysqli_fetch_array($r)) {
	echo '<a href="play.php?name='.$row['filename'].'">'.$row['filename'].'</a>';
	echo "<br>";
}
?>

</body>
<?php
mysqli_close($conn);
?>
</html>