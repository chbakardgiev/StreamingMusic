<!doctype html>
<head>
<meta charset="windows-1252">
<style> 
        .form-group{
            margin: 5%;
        }
    </style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Untitled Document</title></head>
<body>   
<?php
session_start();
if(isset($_SESSION["myusername"])&& isset($_SESSION['mypassword']))
{
?>
<div class="container">
<form class="form-horizontal" name="musicContainer" action="upload.php" method="post" enctype="multipart/form-data">
    <div style="float:left">
    <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-bottom: 5px">
        <span class="btn btn-default btn-file" style="margin-bottom: 5px;margin-top: 5px">
            <span class="fileinput-filename"></span><span class="fileinput-new">
                <input id="audioFile" name="audioFile" accept="audio/*" type="file" >
            </span>
        </span>
            <label>Select genre</label>
            <select name="Select[]" >
                <?php
$conn = mysqli_connect("localhost", "root", "");
mysqli_select_db($conn, "audiolibdb");
$result = mysqli_query($conn, "Select * from genre");
while ( $row = mysqli_fetch_array($result))
        { ?>
                <option  value="<?php echo $row['id']; ?> "><?php echo $row['name']; ?></option>
                
  <?php } 
  mysqli_close($conn); 
  ?>
</select>
        </div>
    </div>
    <input type="submit" class="btn btn-default" style="margin-left: 5px;margin-top: 5px" value="Upload Audio here!" name="save_audio">
<br>
<div style="float: end;margin: 10px" >
<input type="button" class="btn btn-default" style="margin-right: 5px; background-color: goldenrod" value="Music library" id="library" onclick="document.location.href='musiccollection.php';">
<input type="button" class="btn btn-default" style="margin-right: 5px; background-color: red" value="Delete all!" id="delete" onclick="document.location.href='delete.php';">
<input type="button" class="btn btn-default" style="margin-right: 5px; background-color: yellow" value="Log out" id="loggingout" onclick="document.location.href='logout.php'">
</div>
</form>
</div>
</body>
<?php
}
else {
header("location:design.html");
}


