<?php
session_start();
require("./config/pdo.php");
require_once('./class/Employees.php');
require_once('./class/EmployeesManager.php');
require_once('./class/Zoo.php');
require_once('./class/ZooManager.php');
require_once('./class/Enclosures.php');
require_once('./class/EnclosuresManager.php');
require_once('./class/Parc.php');
require_once('./class/Bois.php');
require_once('./class/Volière.php');
require_once('./class/Aquarium.php');



// Utilisation de la fonction getZooById()
$zoo_manager = new ZooManager($pdo); 
$zoo_id = $_GET['zoo_id']; 
$zoo = $zoo_manager->getZooById($zoo_id); 

// Utilisation de la fonction getEmployeeById()
$employee_manager = new EmployeesManager($pdo); 
$employee_id = $_GET['employee_id']; 
$employee = $employee_manager->getEmployeeById($employee_id); 



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="zoo1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Création d'enclos</title>
 
</head>

<body>



<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">
    <img class="img" src="./images/POOZOO-GAME (1).gif" style="width: 40%; height:auto;">
    </a>
  </div>
</nav>


<div class="container" style="position: relative; background-color: transparent;">
  <img src="./images/parchemin.jpg">
  <h2 class="titlezoo"><?php echo $zoo->getName()?></h2>
</div>



<div class="container">
  <br>
  <br>
<h2><img src="./images/enclos.png" style="width: 20%; height:20%;"></h2>
    <form method="post" action="./process/create_enclosure.php" >
        <br>
        <input type="text" name="name" required placeholder="Donne un nom à ton enclos">
        <br>
        <br>
        <select name="type" required>
          <option value="" disabled selected>Choisis ton type d'enclos</option>
          <option value="Parc">Parc </option>
          <option value="Bois">Bois </option>
          <option value="Aquarium">Aquarium</option>
          <option value="Volière">Volière</option>
        </select>
        <input type='hidden' name='employee_id' value='<?= $employee->getId() ?>'>
        <input type='hidden' name='zoo_id' value='<?=  $zoo->getId()?>'>
        <br>
        <br>
      <button class="input-button" type="submit" name="login" value="Login">Créer</button>
      <br>
      <br>
    </form>


 

<?php


     
      $enclosureManager = new EnclosuresManager($pdo);
      $enclosures = $enclosureManager->findAllEnclosuresByEmployeId($employee_id);

      
?>

<div class="container">
<div class='row ps-3 pe-2'>
    <?php foreach ($enclosures as $enclosure) : ?>
    <div class="col mb-3">
      <div class="card text-bg-transparent mb-3" style="max-width: 20rem;">
        <div class="card-body2">
          <h5 class="card-title mt-2"><?= $enclosure->getName() ?></h5>
          <img src="<?= $enclosure->afficherImage() ?>" alt="<?= $enclosure->getName() ?>" style="max-width: 13rem; height: 8rem;">
          <br>
          <br>
          <p class="card-text">Animaux dans l'enclos : <?= $enclosure->countAnimalsInEnclosure($enclosure->getId(), $pdo) ?></p>
          <form action="zoo3.php" method="get">
            <input type="hidden" name="employee_id" value="<?= $employee->getId() ?>">
            <input type="hidden" name="zoo_id" value="<?= $zoo->getId() ?>">
            <input type="hidden" name="enclosure_id" value="<?= $enclosure->getId() ?>">
            <button type="submit" class="button">Choisir</button>
          </form>
          <form action="./process/delete_enclosure.php" method="post">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="employee_id" value="<?= $employee->getId() ?>">
            <input type="hidden" name="zoo_id" value="<?= $zoo->getId() ?>">
            <input type="hidden" name="enclosure_id" value="<?= $enclosure->getId() ?>">
            <button type="submit" class="button2">Supprimer</button>
          </form>
          <br>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</div>


<footer>
    <p class="copyright">POOZOO-GAMING © 2023</p>
</footer>

</body>


</html>
