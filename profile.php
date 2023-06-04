<?php session_start();
require_once 'header.php'; 

if (isset($_COOKIE['logged']))
{
    $_SESSION['user'] = $_COOKIE['logged'];
    setcookie('logged', $_SESSION['user'], time() + 30 * 24 * 3600);
    $user = $_SESSION['user'];
} else {
    header("Location: index.php");
}
    
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=to_do_list;charset=utf8', 'mathis', 'mySQL@dmin072103102009@');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    } 
    
?>

<html>
    <head>
        <title>Mon profil</title>
        <link rel="stylesheet" href="css/styleProfile.css">
    </head>
    <body>
        <p class="name">Identifiant: </p>
        <?php
            echo "<p class='id'>$user</p>"
        ?>
        <form method="POST">
            <p id="newPassword">Modifier le mot de passe: </p><input type="password" id="newPasswordEntry" name="newPassword" 
placeholder="Entrez votre nouveau mot de passe" required minlength="5" maxlength="30">
        </form>
    </body>
</html>

<?php

if (isset($_POST['newPassword']))
{
    $newPassword = htmlentities($_POST['newPassword']);
    $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $sqlQuery = "UPDATE users SET password=\"$newPassword\" WHERE name=\"$user\"";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $newPassword = NULL;
    header("Refresh: 0");
}

