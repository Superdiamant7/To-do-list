<html>
    <head>
        <link rel="stylesheet" href="style2.sass">
        <title>Bienvenue sur liste des tâches</title>
        <?php require_once 'users.php'; ?>
    </head>
    <body>
        <h1>Se connecter :</h1>
        <form method="POST">
            <span id="text1">nom d'utilisateur :</span> <input name="nu" id="nu" type="text" placeholder="Entrez votre nom d'utilisateur" required maxlength="50"><br>
            <span id="text2">mot de passe :</span> <input name="mdp" id="mdp" type="password" placeholder="Entrez votre mot de passe" required maxlength="50"><br>
            <button>Se connecter</button>
        </form>
    </body>
</html>