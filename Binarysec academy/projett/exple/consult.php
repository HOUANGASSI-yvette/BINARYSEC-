<?php

session_start();
include_once("connexionbd.php");
$setnom = $_SESSION['nom'];
if(isset($_POST['del'])) {
    $sql = "DELETE FROM candidats WHERE nom = '$setnom' OR prenom = '$setnom'";
    $result = mysqli_query($conn, $sql);


    $sql1 = "UPDATE etudiants SET etat = 0 WHERE nom = '$setnom' OR prenom = '$setnom'";
    $result1 = mysqli_query($conn, $sql1);

    echo "Candidature supprimée avec succès";
  header("Location:conected.php");

    if ($result) {
        echo 'ok!!';
    } else echo "Error";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./img/logo.jpeg" type="image/x-icon">
    <title>Consultation</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            align-items: center;
            justify-content: center;
        }

        .alb {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .left a {
            font-family: 'Cinzel', serif;
        }

        .right {

            justify-content: end;
            align-items: center;
            text-align: center;
        }

        .right p {
            font-family: sans-serif;
        }

        .header {
            box-shadow: 2px 0 0 2px #000;
        }


        @media screen {
            img {}
        }



        /* Styles pour l'affichage lors de l'impression */
        @media print {
            @page {
                size: auto;
                margin: 5mm;
                height: 200mm;
            }

            body {
                margin: 0;
                padding: 0;
            }

            /* Styles pour l'affichage lors de l'impression */
            .no-print,.retour {
                display: none;
            }

            .navbar {
                padding-top: 50px;
            }

        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary pt-0 px-2 mb-5">
        <div class="container-fluid justify-content-between header">
            <div class="left d-flex">
                <span>
                    <img src="./img/logo.jpeg" alt="" style="height:100px; width:120px;">
                </span>
                <a class="navbar-brand fs-3 mx-2" href="index.php">Institut Africain </br> d'Informatique(<span class="fw-bold">IAI-TOGO</span>)</a>
            </div>
            <div class="right">
                <p>REPUBLIQUE TOGOLAISE
                    <br>
                    Travail - Liberte - patrie
                </p>
            </div>
        </div>
    </nav>
    <h3 class="text-uppercase text-center mt-4 text-decoration-underline">Fiche d'inscription</h3>
    <section class="container d-flex">
        <?php

        include('connexionbd.php');
        $sql = "SELECT * FROM candidats where nom = '$setnom' or prenom = '$setnom'";
        $res = mysqli_query($conn, $sql);
        $images = mysqli_fetch_assoc($res);

        ?>

        <table class="table" id='myTable'>
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col"><?= $images['nom'] ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Prenom</th>
                    <td><?= $images['prenom'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Date de Naissance</th>
                    <td><?= $images['date_de_naissance'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Nationalité</th>
                    <td><?= $images['nationalité'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Sexe</th>
                    <td><?= $images['sexe'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Type de bac</th>
                    <td><?= $images['typedebac'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Année d'Obtention</th>
                    <td><?= $images['année_d_obtention'] ?></td>
                </tr>
                <tr class="mt-3 no-print">

                        <th scope="row" class="text-center"><a href="update.php"><button class="btn btn-warning w-75">Modifier</button></a></th>

                        <td >
                            <form  method="post">
                                <button class="btn btn-danger w-75" type="submit" for="submit" name="del">Supprimer</button>
                            </form>
                        </td>

                    <td class="text-center"><button onclick="generatePDF()" class="btn btn-primary w-75">Télecharger PDF</button></td>
                        <!-- <td class="text-center"><button class="btn btn-success w-75">Valider</button></td> -->
                </tr>
            </tbody>
        </table>
        <div class="alb pt-3" style="width: 200px; height:200px; margin-bottom:35px; margin-top:25px; padding-left:-25px;">
            <a href='<?= "Photos/" . $images['lien_photo'] ?>'>
                <img src='<?= "Photos/" . $images['lien_photo'] ?>' alt="" style="width: 100%; height:100%;">

            </a>
        </div>



    </section>
    <div class="mt-5">
        <p class="retour fs-3 text-center mt-5 "><a class="text-underline text-black" href="conected.php">Retour </a></p>

    </div>


    <script>
        function genratePDF() {
            // Obtenez tous les éléments de la table
            const table = document.getElementById('myTable');

            // Créer un objet Blob contenant le HTML de la table
            const blob = new Blob([table.outerHTML], {
                type: 'application/html'
            });

            // Créer un URL pour le Blob
            const url = URL.createObjectURL(blob);

            // Ouvrir une nouvelle fenêtre avec le contenu HTML
            const newWindow = window.open(url, '_blank');

            // Libérer l'URL de l'objet Blob
            URL.revokeObjectURL(url);
        }

        function generatePDF() {
            // Appeler la fonction window.print() pour imprimer la page actuelle
            window.print();
        }
    </script>
</body>

</html>