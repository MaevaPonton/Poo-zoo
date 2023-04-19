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

$employee_id = $_POST['employee_id'];
$zoo_id = $_POST['zoo_id'];
$enclosure_id = $_POST['enclosure_id'];
$enclosureManager = new EnclosuresManager($pdo);
$enclosureManager->delete($enclosure_id);

header("location: ../zoo2.php?employee_id=". $_POST['employee_id'] ." &zoo_id=". $_POST['zoo_id'] ."");