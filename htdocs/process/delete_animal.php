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


$employee_id = $_POST['employee_id'];
$zoo_id = $_POST['zoo_id'];
$enclosure_id = $_POST['enclosure_id'];
$animal_id = $_POST['animal_id'];
$animalManager = new AnimalsManager($pdo);
$animalManager->delete($animal_id);

header("location: ../zoo3.php?employee_id=". $_POST['employee_id'] ." &zoo_id=". $_POST['zoo_id'] ." &enclosure_id=". $_POST['enclosure_id'] ."");