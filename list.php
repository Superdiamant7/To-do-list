<?php

session_start();
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

if (isset($_POST['form']))
{
    $newTask = htmlentities($_POST['form']);
    $sqlQuery = "INSERT INTO tasks (user, text) VALUES (\"$user\", \"$newTask\")";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    $newTask = NULL;
    header("refresh: 0");
}

if (isset($_COOKIE['order']))
{
    $order = $_COOKIE['order'];
} else {
    $order = "asc";
}

if (isset($_POST['order']))
{
    if ($_POST['order'] == 'orderC')
    {
        $order = "asc";
        setcookie('order', $order, time() + 10000 * 24 * 3600);
    } else {
        $order = "desc";
        setcookie('order', $order, time() + 10000 * 24 * 3600);
    }
}

if ($order == "asc")
{
    $sqlQuery = "SELECT * FROM tasks WHERE user=\"$user\" ORDER BY id ASC";
} elseif ($order == "desc") {
    $sqlQuery = "SELECT * FROM tasks WHERE user=\"$user\" ORDER BY id DESC";
}

$result = $db->prepare($sqlQuery);
$result->execute();

echo "<form method='POST'><ol class='list'>";
while ($row = $result->fetch())
{
    echo "<li>" . $row['text'] . 
"<button class='sup' name='sup' value='" . $row['id'] . "'>Supprimer</button>" . "</li><br>";
}
echo "</ol></form>";

if (isset($_POST['sup']))
{
    $id = $_POST['sup'];
    $sqlQuery = "DELETE FROM tasks WHERE id=" . $id;
    $result = $db->prepare($sqlQuery);
    $result->execute();
    header("refresh: 0");
}

if (isset($_POST['supAll']))
{
    $sqlQuery = "DELETE FROM tasks WHERE user=\"$user\"";
    $result = $db->prepare($sqlQuery);
    $result->execute();
    header("refresh: 0");
}

if (isset($_POST['exit']))
{
    setcookie('logged');
    session_destroy();
    header("Location: index.php");
}