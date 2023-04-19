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





 
$data = [
    'zoo_id' => $_POST['zoo_id'],
    'employee_id' => $_POST['employee_id'],
    'name' => $_POST['name'],
    'type' => $_POST['type'],
    ];

    switch ($_POST['type']) {
        case 'Aquarium':
          $enclosure = new Aquarium ($data);
          break;
        case 'Volière':
          $enclosure = new Volière($data);
          break;
        case 'Parc':
          $enclosure = new Parc($data);
          break;
        case 'Bois':
            $enclosure = new Bois($data);
            break;
    }

      
      
      

      $enclosureManager = new EnclosuresManager($pdo);
      $enclosureManager->add($enclosure);


      header("location: ../zoo2.php?employee_id=". $_POST['employee_id'] ." &zoo_id=". $_POST['zoo_id'] ."");
