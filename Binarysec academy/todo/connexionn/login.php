<?php
session_start();
include_once "./connexionbd.php";
global $conn;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST["username"];
        $password = md5($_POST['password']);


        $sql = "SELECT * FROM utilisateur WHERE username = '$username' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $num_lignes = mysqli_num_rows($result);
            if ($num_lignes > 0) {

                $sql = "SELECT * FROM utiliisateur WHERE username = '$username' AND password = '$password'";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $num_lignes = mysqli_num_rows($result);
                    if ($num_lignes > 0) {

                        $sql = "SELECT * FROM utiliisateur WHERE username = '$username'";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['password'] = $row['password'];
                        }
                        header("Location:bienvenu.php");
                        exit();
                        // Rest of your code
                    } else {
                        $erreur = "Nom d'utilisateur ou Mot de passe incorrect!!!";
                        header("Location:connexion.php?error=$erreur");

                    }
                } else {
                    // Handle the case where the query fails
                    echo "Error: " . mysqli_error($conn);
                }
            }else {
                $erreur = "Nom d'utilisateur ou Mot de passe incorrect!!!";
                header("Location:connexion.php?error=$erreur");

            }

        }
    }
}

