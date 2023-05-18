<?php
require_once 'list.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="style.sass">
        <title>Liste de tâches</title>
    </head>
    <body>
        <h1>Liste de tâches</h1>
        <form method="POST">
            <p id="order">Ordre: </p>
            <button name="order" class="orderC<?php
                if ($order == "asc") {echo "_";}
             ?>" value="orderC">Croissant</button>
            <button name="order" class="orderD<?php
                if ($order == "desc") {echo "_";}
             ?>" value="orderD">Décroissant</button>
        </form>
        <form method="POST">
            <button name="supAll" id="supALL">Tout supprimer</button>
        </form>
        <div>
            <form method="POST">
                <input placeholder="Entrer une nouvelle tâche" 
                        required id="form" name="form" maxlength="63">
                <button id="newTask">Ajouter une nouvelle tâche</button>
            </form>
        </div>  
        <form method="POST">
            <button name="exit" id="exit">Se déconnecter</button>
        </form>
    </body> 
</html>