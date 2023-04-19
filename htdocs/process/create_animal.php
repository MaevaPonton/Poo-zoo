<?php
session_start();
require("../config/pdo.php");
require_once('../class/Employees.php');
require_once('../class/EmployeesManager.php');
require_once('../class/Zoo.php');
require_once('../class/ZooManager.php');
require_once('../class/Enclosures.php');
require_once('../class/EnclosuresManager.php');
require_once('../class/Parc.php');
require_once('../class/Bois.php');
require_once('../class/Volière.php');
require_once('../class/Aquarium.php');
require_once('../class/Animals.php');
require_once('../class/AnimalsManager.php');
require_once('../class/Aigles.php');
require_once('../class/Ours.php');
require_once('../class/Tigres.php');
require_once('../class/Poissons.php');

function pretyDump($data){
  highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
}


$data = [
    'enclosure' => $_POST['enclosure_id'],
    'zoo_id' => $_POST['zoo_id'],
    'employee_id' => $_POST['employee_id'],
    'name' => $_POST['name'],
    'species' => $_POST['species'],
    'size' => $_POST['size'],
    'weight' => $_POST['weight'],
    'age' => $_POST['age'],
    ];


    switch ($_POST['species']) {
        case 'Ours':
          $animal = new Ours ($data);
          break;
        case 'Aigle':
          $animal = new Aigles($data);
          break;
        case 'Poisson':
          $animal = new Poissons($data);
          break;
        case 'Tigre':
            $animal = new Tigres($data);
            break;
      }

      $animalManager = new AnimalsManager($pdo);
      $animalManager->add($animal);
     

      header("location: ../zoo3.php?employee_id=". $_POST['employee_id'] ." &zoo_id=". $_POST['zoo_id'] ." &enclosure_id=". $_POST['enclosure_id'] ."");