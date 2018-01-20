<!DOCTYPE html>
<html>
    <title>
    <head>Play</head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </title>
<body >
        <?php
        session_start();
        if(!isset($_SESSION['myusername'])||!isset($_SESSION['mypassword'])){
            header("location:design.html");
        }
        ?>
    <audio controls autoplay>
    <source  src="<?php echo $_GET['name']; ?>" type="audio/mpeg">
</audio>
<p><a href="musiccollection.php">Music collection</a><p>
</body>
</html>