<?php
session_start();
global $conn;
include('connexionbd.php');


if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $datenaiss = $_POST["datenaiss"];
    $nation = $_POST["nation"];
    $sexe = $_POST["sexe"];
    $bac = $_POST["bac"];
    $anneeobt = $_POST["anneeobt"];

    // Traitement de l'upload de la photo
    $imag_name = $_FILES['photo']['name'];
    $imag_size = $_FILES['photo']['size'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $dest = './Photos/' . $imag_name;
    $error = $_FILES['photo']['error'];

    if ($error === 0) {
        if ($imag_size > 125000) {
            $em = "Volume d'image trop grand!!!";
            header("Location:candidature.php?error=$em");
            exit();  // Arrêter l'exécution du script en cas d'erreur
        } else {
            $img_ex = pathinfo($imag_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array('jpg', 'jpeg', 'png');

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'Photos/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Insérer les données dans la base de données
                $sql = "INSERT INTO candidats (nom, prenom, date_de_naissance, nationalité, sexe, lien_photo, typedebac, année_d_obtention, idetu)
                    SELECT '$nom', '$prenom', '$datenaiss', '$nation', '$sexe', '$new_img_name', '$bac', '$anneeobt',idetu
                    FROM etudiants 
                    WHERE nom = '$nom' or nom = '$prenom'";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    // Mise à jour de la colonne 'Etat' dans la table 'etudiants'
//                    $sql_update = "UPDATE etudiants SET Etat = 1 WHERE nom = '$nom'";

                    $sqle = "select * from etudiants";
                    $resulte=mysqli_query($conn,$sqle);

                    $sql_update = "UPDATE etudiants 
                       SET etat = 1 
                       WHERE idetu IN (SELECT idetu 
                                        FROM candidats 
                                        WHERE nom = '$nom' OR prenom = '$prenom')";

                    $result_update = mysqli_query($conn, $sql_update);

                    if ($result_update) {
                        echo "La colonne 'note' a été mise à jour avec succès.";
                    } else {
                        echo "Erreur lors de la mise à jour de la colonne 'nom': " . mysqli_error($conn);
                    }

                    // Redirection vers la page de connexion après l'inscription réussie
                    header("Location: conected.php");
                    exit();  // Assurer que le script s'arrête après la redirection
                } else {
                    echo "Erreur lors de l'insertion des données: " . mysqli_error($conn);
                }
            } else {
                $em = "Ces types de fichiers ne sont pas permis !!!";
                header("Location: candidature.php?error=$em");
                exit();  // Arrêter l'exécution du script en cas d'erreur
            }
        }
    }
}
?>