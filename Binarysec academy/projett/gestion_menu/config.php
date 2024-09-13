<?php

$conn = mysqli_connect('localhost','root','','fastfood');
		
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
} else {
    "";
}

    
?>