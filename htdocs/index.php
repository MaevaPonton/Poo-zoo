<?php
session_start();
require_once './config/pdo.php';
require_once './class/Zoo.php';
require_once './class/Employees.php';
require_once './class/ZooManager.php';
require_once './class/EmployeesManager.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Mon Zoo</title>
</head>

<body>

<div class = 'présentation'> 
    <div>Bienvenue dans le meilleur jeu de création et gestion de zoos: </div>
</div>
    <br>
    <h1 ><img class="img" src="./images/POOZOO-GAME (1).gif" ></h1>

    
    
    <div class="container mx-auto ">
        <br>
      <h2><img src="./images/zoo2.png "style="width: 30%; height:30%;"></h2>
      <br>
      <br>
        <form method="post" action="./process/create_zoo.php">
              <input type="text" name="name" required placeholder="Donne un nom à ton zoo">
              <br>
              <br>
              <button class="input-button " type="submit" name="login" value="Login">Créer</button>
              <br>
              <br>
        </form>
    


<?php


    $zooManager = new ZooManager($pdo);
    $zoos = $zooManager->getAllZoos();
    

?>

    
<div class='row ps-3 pe-2 flex-wrap justify-content-center'>
    <?php foreach ($zoos as $zoo): ?>
        <div class='col-md-3'>
            <div class='card mb-3'>
            <img src="./images/images.jpeg" class="mx-auto" style="max-width: 100%; height: auto;">
                <div class='card-body2'>
                    <h5 class='card-title'><?= $zoo->getName() ?></h5>
                    <br>
                    <p class='card-text'> Nombre d'employés : <?= $zooManager->countEmployeesInZoo($zoo->getId()) ?> </p>
                    <p class='card-text'> Nombre d'enclos : <?= $zooManager->countEnclosuresInZoo($zoo->getId()) ?> </p>
                    <p class='card-text'>Nombre d'animaux : <?= $zooManager->countAnimalsInZoo($zoo->getId()) ?> </p>
                    <br>
                    <form action='zoo1.php' method='get'>
                            <input type='hidden' name='zoo_id' value='<?= $zoo->getId() ?>'>
                            <button type='submit' class="button"> Choisir </button>
                    </form>
                    <br>
                    <form action='./process/delete_zoo.php' method='post'>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='zoo_id' value='<?= $zoo->getId() ?>'>
                            <button type='submit' class="button2"> Supprimer </button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>
</body>

<footer>
    <p class="copyright">POOZOO-GAMING © 2023</p>
</footer>
</html>
