<html>
    <?php require_once 'header.php'; require_once 'newUser.php'; ?>
    <head>
        <link rel="stylesheet" href="css/styleSignUp.css">
        <title>S'inscrire</title>
    </head>
    <body>
        <h1>S'inscrire</h1>
        <form method="POST" class="SignUp">
            Identifiant : <input id="id" name="id" maxlength="20" required placeholder="Entrez votre identifiant"><br><br>
            Mot de passe : <input id="mdp" name="mdp" maxlength="100" required placeholder="Entrez votre mot de passe" type="password"><br>
            <button>S'inscrire</button>
        </form>
        <a href="index.php" class="seConnecter">Vous avez déjà un compte ? Connectez vous !</a>
    </body>
</html>