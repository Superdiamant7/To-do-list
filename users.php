<?php

session_start();

if (isset($_COOKIE['logged']))
{
    header("Location: home.php");
}

try
{
    $db = new PDO('mysql:host=localhost;dbname=to_do_list;charset=utf8', 'mathis', 'mySQL@dmin072103102009@');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if (isset($_POST['nu']) && isset($_POST['mdp']))
{
    $nu = htmlentities($_POST['nu']);
    $mdp = htmlentities($_POST['mdp']);

    $sqlQuery = "SELECT * FROM users WHERE name=\"$nu\"";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $row = $result->fetch();

    if (password_verify($mdp, $row['password']))
    {
        $_SESSION['user'] = $nu;
        setcookie('logged', $_SESSION['user'], time() + 30 * 24 * 3600);
        header("Location: home.php");
    } else {
        echo "<p class='result'>Votre nom d'utilisateur ou nom de passe est invalide !</p>";
    }
}