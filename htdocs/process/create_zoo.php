<?php
session_start();
require_once '../config/pdo.php';
require_once '../class/Zoo.php';
require_once '../class/Employees.php';
require_once '../class/ZooManager.php';
require_once '../class/EmployeesManager.php';

$data = [
    'name' => $_POST['name'],
];

$zoo = new Zoo($data);
$zooManager = new ZooManager($pdo);
$zooManager->addZoo($zoo);

header("location: ../index.php");