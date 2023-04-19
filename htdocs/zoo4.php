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

// Utilisation de la fonction getAnimalById()
$animal_manager = new AnimalsManager($pdo); 
$animal_id = $_GET['animal_id']; 
$animal = $animal_manager->getAnimalById($animal_id); 


$animalManager = new AnimalsManager($pdo);
$animals = $animalManager->findAllAnimalsByEnclosureId($enclosure_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="zoo4.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Carte d'identité de l'animal</title>
</head>

<body>

<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">
    <img class="img" src="./images/POOZOO-GAME (1).gif" style="width: 40%; height:40%;">
    </a>
  </div>
</nav>


<div class="container">
<div class="card" style="width: 30rem;">
  <img src="./images/carnet_de_sante-2018.jpg" class="card-img-top" alt="...">
  <h2 class="title" style="font-size: 2.5rem;"><?= $animal->getName() ?></h2>
  <div class="card-body">
      <p class="etat"><?php $animal->etat(); ?></p>
  </div>
</div>
</div>


</body>

<footer>
    <p class="copyright">POOZOO-GAMING © 2023</p>
</footer>


</html>