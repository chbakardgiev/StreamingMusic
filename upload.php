<!doctype html>
<html>
<head>
<meta charset="windows-1252">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Untitled Document</title>
</head>
<?php
if(!isset($_FILES['audioFile']['name']))
{
    echo "<script>alert('Please upload a file');</script>";
    header("location:server.php");
}
$allowed =  array('mp3','wav' ,'ogg');
$filename = $_FILES['audioFile']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if(!in_array($ext,$allowed) ) {
    die("Incorrect format!");
}
session_start();
$privateMusicCollection = $_SESSION['myusername'];
if(!is_dir('uploads/'.$privateMusicCollection.'/'))
{
    mkdir('uploads/'.$privateMusicCollection.'/');
}
	if(isset($_POST['save_audio']) && $_POST['save_audio'] == "Upload Audio here!")
{ 
	$dir = 'uploads/'.$privateMusicCollection.'/';
	$audio_path = $dir.basename($_FILES['audioFile']['name']);
	move_uploaded_file($_FILES['audioFile']['tmp_name'], $audio_path);
	saveAudio($audio_path);
	displayAudios();
}
function displayAudios(){
	$conn = mysqli_connect('localhost','root','','audiolibdb');
if(!$conn){
	die('server not connected');
}

    header("location: musiccollection.php");
    mysqli_close($conn);
}


function saveAudio($fileName){
    $db = new PDO('mysql:host=localhost; dbname=audiolibdb; charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try{
$db->beginTransaction();
$myusername = $_SESSION['myusername'];
$preparedStatement = $db->prepare('INSERT INTO `audios` (`filename`, `owner`, `genre`)VALUES (:filename, :owner, :genre)');
foreach($_POST['Select'] as $genre)
{
$preparedStatement->execute([
        'filename' => $fileName,
        'owner' => $myusername,
        'genre' => $genre
    ]);
}
$db->commit();
}
 catch (PDOException $e){
      $db->rollback();
    throw "FIle not saved. Please try again!";
 }
}


if(mysqli_affected_rows($conn)>0){
	echo "<script>alert('directory to the audio file is saved successfully!')</script>";
}
mysqli_close($conn);

?>
<button value="Delete" id="delete" onclick="document.location.href='delete.php';">Delete all!</button>
</html>