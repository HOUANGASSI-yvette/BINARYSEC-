<?php
session_start();
include_once "./connexionbd.php";
$username=$_SESSION['username'];
global $conn;
$sql = "SELECT username FROM utilisateur WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo $row["username"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page de bienvenu</title>
    <link rel="stylesheet" href="connexion.css">

</head>
<body>
    <div class="wraper">
        <form action="logout.php">
            <p> Bienvenu cher <span><?= $row["username"]?></span></p>
            <button type="submit" class="btn welcome">se deconnecter </button>
        </form>
    </div> 
    
</body>
</html>