<?php
session_start();
include_once "./connexionbd.php";
global $conn;

function emailExists($email)
{
    global $conn;

    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT COUNT(*) AS count FROM utilisateur WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        return $count > 0; // Si $count > 0, l'e-mail existe
    } else {
        // Gérer les erreurs de la requête SQL
        return false;
    }

}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]); // Hacher le mot de passe
    $confirmPassword =md5($_POST["confirmPassword"]);
    // Vérifier si les mots de passe correspondent
    if ($password !== $confirmPassword) {
        $error = "Les mots de passe ne correspondent pas.";
        header("Location:inscription.php?error=$error");
    } else {

        if (emailExists($email)) {
            $error = "Utilisateur déjà existant!!!";
            header("Location:inscription.php?error=$error");
        } else {
            // Le mot de passe est valide, insérer les données dans la base de données
            $sql = "INSERT INTO utiliisateur(username, email, password) VALUES ('$username', '$email', '$password')";

            if (mysqli_query($conn, $sql)) {
                // Rediriger l'utilisateur vers la page de connexion
                header("Location: connexion.php");
                exit();
            } else {
                // Gérer les erreurs d'insertion dans la base de données
                echo "Erreur : " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

