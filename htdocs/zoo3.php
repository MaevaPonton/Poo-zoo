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
require_once('./class/Animals.php');
require_once('./class/AnimalsManager.php');
require_once('./class/Aigles.php');
require_once('./class/Ours.php');
require_once('./class/Tigres.php');
require_once('./class/Poissons.php');

function pretyDump($data){
  highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
}



// Utilisation de la fonction getZooById()
$zoo_manager = new ZooManager($pdo); 
$zoo_id = $_GET['zoo_id']; 
$zoo = $zoo_manager->getZooById($zoo_id); 

// Utilisation de la fonction getEmployeeById()
$employee_manager = new EmployeesManager($pdo); 
$employee_id = $_GET['employee_id']; 
$employee = $employee_manager->getEmployeeById($employee_id); 

// Utilisation de la fonction getEnclosureById()
$enclosure_manager = new EnclosuresManager($pdo); 
$enclosure_id = $_GET['enclosure_id']; 
$enclosure = $enclosure_manager->getEnclosureById($enclosure_id); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="zoo1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Création d'animaux</title>
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
    <h2 class="titlezoo"><?php echo $zoo->getName() ?></h2>
  </div>



<div class="container">
  <br>
  <h2><img src="./images/animal.png" style="width: 20%; height:20%;"></h2>
    <form method="post" action="./process/create_animal.php" >
      <br>
        <input type="text" name="name" placeholder="Donne un nom à ton animal" required>
        <br>
        <br>
        <select name="species" required>
          <option value="" disabled selected>Choisis ton animal</option>
          <option value="Ours">Ours 🦦</option>
          <option value="Poisson">Poisson 🐟 </option>
          <option value="Tigre">Tigre 🐅</option>
          <option value="Aigle">Aigle 🦅</option>
        </select>
        <br>
        <br>
        <select name="age" required>
            <option value="">Age</option>
            <?php
                for ($i = 1; $i <= 100; $i++) {
                echo "<option value=\"$i\">$i</option>";
                }
            ?>
        </select>
        <select name="size" required>
            <option value="">Taille</option>
            <?php
                for ($i = 1; $i <= 300; $i++) {
                echo "<option value=\"$i\">$i</option>";
                }
            ?>
        </select>
        <select name="weight" required>
            <option value="">Poids</option>
            <?php
                for ($i = 1; $i <= 300; $i++) {
                echo "<option value=\"$i\">$i</option>";
                }
            ?>
        </select>
        <br>
        <br>
      <input type='hidden' name='zoo_id' value='<?=  $zoo->getId()?>'>
      <input type='hidden' name='employee_id' value='<?= $employee->getId() ?>'>
      <input type='hidden' name='enclosure_id' value='<?= $enclosure->getId()?>'>
      <button class="input-button" type="submit" name="login" value="Login">Créer</button>
      <br>
      <br>
    </form>



<?php

      $animalManager = new AnimalsManager($pdo);
      $animals = $animalManager->findAllAnimalsByEnclosureId($enclosure_id);
  
    
      ?>


<div class='row ps-3 pe-2'>
    <?php foreach ($animals as $animal) : ?>
      <div class='col justify-content-center'>
        <div class='card text-bg-transparent mb-3'>
          <div class='card-body2'>
            <h5 class='card-title mt-2'><?= $animal->getName() ?> </h5>
            <img src="<?= $animal->afficherImage() ?>" alt="<?= $animal->getName() ?>" style='max-width: 10rem; height: auto;'>
            <div class='buttons-container' style='position:absolute; bottom:0;'>
              <form action='zoo4.php' method='get'>
                <input type='hidden' name='employee_id' value='<?= $employee->getId() ?>'>
                <input type='hidden' name='zoo_id' value='<?=  $zoo->getId()?>'>
                <input type='hidden' name='enclosure_id' value='<?= $enclosure->getId()?>'>
                <input type='hidden' name='animal_id' value='<?= $animal->getId()?>'>
                <button type='submit' class='button'>Carnet de santé</button>
              </form>
              <form action='./process/delete_animal.php' method='post'>
                <input type='hidden' name='action' value='delete'>
                <input type='hidden' name='employee_id' value='<?= $employee->getId() ?>'>
                <input type='hidden' name='zoo_id' value='<?= $zoo->getId() ?>'>
                <input type='hidden' name='enclosure_id' value='<?= $enclosure->getId() ?>'>
                <input type='hidden' name='animal_id' value='<?= $animal->getId() ?>'>
                <button type='submit' class='button2'>Supprimer</button>
                <br>
                <br>
              </form> 
            </div>
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