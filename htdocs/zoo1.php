<?php
session_start();
require("./config/pdo.php");
require_once('./class/Employees.php');
require_once('./class/EmployeesManager.php');
require_once('./class/Zoo.php');
require_once('./class/ZooManager.php');



function pretyDump($data)
{
  highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
}


$zoo_manager = new ZooManager($pdo);
$zoo_id = $_GET['zoo_id'];
$zoo = $zoo_manager->getZooById($zoo_id);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="zoo1.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>Création d'employés</title>

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





  <div class="container mx-auto">
    <br>
    <br>
    <h2><img src="./images/employé.png" style="width: 30%; height:30%;"></h2>
    <form method="post" action="./process/create_employee.php">
      <br>
      <input type="text" name="pseudo" required placeholder="Donne lui un prénom">
      <br>
      <br>
      <select name="gender" required>
        <option value="" disabled selected>Choisis ton genre</option>
        <option value="M">Homme</option>
        <option value="F">Femme</option>
        <option value="A">Autre</option>
      </select>
      <br>
      <br>
      <input type="number" name="age" required placeholder="Quel est son âge ?">
      <br>
      <br>
      <input type='hidden' name='zoo_id' value='<?= $zoo->getId() ?>'>
      <button class="input-button" type="submit" name="login" value="Login">Créer</button>
      <br>
      <br>
    </form>


    <?php


    $employeeManager = new EmployeesManager($pdo);
    $employees = $employeeManager->getEmployeesByZooId($zoo_id);

    ?>

    <div class='row ps-3 pe-2'>
      <?php foreach ($employees as $employee) : ?>
        <div class='col-md-3'>
          <div class='card mb-3'>
            <img src='./images/soigneur.webp' alt='employee picture' class="employee-picture">
            <div class='card-body'>
              <h5 class='card-title'>Employé(e) : <?php echo $employee->getPseudo() ?> </h5>
              <p class='card-text'> Nombre d'enclos : <?= $employeeManager->countEnclosuresToEmployees($employee->getId()) ?> </p>
              <p class='card-text'>Nombre d'animaux : <?= $employeeManager->countAnimalsToEmployees($employee->getId()) ?></p>
              <form action='zoo2.php' method='get'>
                <input type='hidden' name='employee_id' value='<?= $employee->getId() ?>'>
                <input type='hidden' name='zoo_id' value='<?= $zoo->getId() ?>'>
                <button type='submit' class='button'>Choisir</button>
                <br>
              </form>
              <form action='./process/delete_employee.php' method='post'>
                <input type='hidden' name='action' value='delete'>
                <input type='hidden' name='employee_id' value='<?= $employee->getId() ?>'>
                <input type='hidden' name='zoo_id' value='<?= $zoo->getId() ?>'>
                <button type='submit' class='button2'>Supprimer</button>
              </form>
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