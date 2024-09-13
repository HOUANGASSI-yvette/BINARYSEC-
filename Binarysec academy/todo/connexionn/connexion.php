<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="connexion.css">
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
        <form action="login.php" method="post" id="form">
        <h1> se connecter</h1>
        <!-- creation des boites de dialogues avec l'utilisateur-->
           <div class="input-box">
                <input type="text" id="nom" name="username" placeholder=" Entrer votre nom d'utilisateur" required>
                <i class='bx bxs-user'></i>
            </div>
             <div class="input-box">
            <input type="password" id="password" name="password" placeholder="Entrer votre mot de passe" required>
            <i class='bx bxs-lock-alt'></i>
             </div>
            <div class="remember-forgot">
            <a href="#"> Mot de passe oublié?</a>
            <label><input type="checkbox"> Me rappeler</label>
        </div>
        <span id="error"><?php if(isset($_GET["error"]))echo $_GET['error'] ?></span>
        <button type="submit" class="btn"> <a href="../index.php" >Se connecter</a> </button>

        <div class="register-link">
            <p> Vous n'avez pas de compte ? <a href="./inscription.php">S'inscrire</a></p>
        </div>
        </form>
    </div>
</body>
</html>