<?php
session_start();
require("../config/pdo.php");
require_once('../class/Employees.php');
require_once('../class/EmployeesManager.php');
require_once('../class/Zoo.php');
require_once('../class/ZooManager.php');

function pretyDump($data){
    highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
  }


$data = [
    'zoo_id' => $_POST['zoo_id'],
    'pseudo' => $_POST['pseudo'],
    'gender' => $_POST['gender'],
    'age' => $_POST['age'],
    ];

$employee = new Employees($data);
$employeeManager = new EmployeesManager($pdo);
$employeeManager->add($employee);

header("location: ../zoo1.php?zoo_id=". $_POST['zoo_id'] ."");
