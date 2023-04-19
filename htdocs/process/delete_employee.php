<?php
session_start();
require_once '../config/pdo.php';
require_once '../class/Zoo.php';
require_once '../class/Employees.php';
require_once '../class/ZooManager.php';
require_once '../class/EmployeesManager.php';

$employee_id = $_POST['employee_id'];
$zoo_id = $_POST['zoo_id'];
$employeeManager = new EmployeesManager($pdo);
$employeeManager->deleteEmployee($employee_id);

header("location: ../zoo1.php?zoo_id=". $_POST['zoo_id'] ."");