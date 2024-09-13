<?php

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page d' inscription</title>
    <link rel="stylesheet" href="connexion.css">
    <script src="script.js"> async</script>
</head>
<body>
<style>
        #error{
            margin-bottom: 10px;
    text-align: center;
    color: red;
    font-weight: bolder;
}
    </style>
    <div class="wrapper">
        <form action="register.php" id="form" method="post">
        <h1> s'inscrire</h1>
        <!-- creation des boites de dialogues avec l'utilisateur-->
        <div class="input-box">
            <input type="email" id="email" name="email" placeholder="Entrer votre email">
            <i class='bx bx-envelope' ></i>
        </div>
        
        <div class="input-box">
            <input type="text" id="nom" name="username" placeholder="Entrer votre nom d'utilisateur " required>
            <i class='bx bxs-user'></i>
        </div>
        
        <div class="input-box">
        <input type="password" id="password" name="password" placeholder="Entrer votre mot de passe" required>
        <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="input-box">
        <input type="password" id="confirmPassword" name="confirmPassword"placeholder="Confirmer votre mot de passe" required>
        <i class='bx bxs-lock-alt'></i>
        </div>
        <span id="error"><?php if(isset($_GET["error"]))echo $_GET['error'] ?></span>
        <button type="submit" name="submit" class="btn">S'inscrire</button>

        <div class="register-link">
            <p> Vous avez un compte ? <a href="./connexion.php"> Se connecter</a></p>
        </div>
        </form>


</body>
</html>