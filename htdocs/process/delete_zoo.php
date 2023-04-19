<?php
session_start();
require_once '../config/pdo.php';
require_once '../class/Zoo.php';
require_once '../class/Employees.php';
require_once '../class/ZooManager.php';
require_once '../class/EmployeesManager.php';

$zoo_id = $_POST['zoo_id'];
$zooManager = new ZooManager($pdo);
$zooManager->deleteZoo($zoo_id);

header("location: ../index.php");