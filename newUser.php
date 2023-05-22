<?php

session_start();

try
{
    $db = new PDO('mysql:host=localhost;dbname=to_do_list;charset=utf8', 'mathis', 'mySQL@dmin072103102009@');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if (isset($_POST['id']) && isset($_POST['mdp']))
{
    $id = htmlentities($_POST['id']);
    $mdp = htmlentities($_POST['mdp']);
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $sqlQuery = "SELECT name FROM users WHERE name=\"$id\"";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $row = $result->fetch();
    if ($row != false)
    {
        if ($row['name'] == $id)
        {
            echo "Identifiant déjà pris";
        }
    } else {
        $sqlQuery = "INSERT INTO users (name, password) VALUES (\"$id\", \"$mdp\")";
        $result = $db->prepare($sqlQuery);
        $result->execute();
        $_SESSION['user'] = $id;
        setcookie('logged', $_SESSION['user'], time() + 30 * 24 * 3600);
        header("Location: home.php");
    }
}
