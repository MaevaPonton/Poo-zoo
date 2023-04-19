<?php
try{
$pdo = new  PDO('mysql:host=127.0.0.1;dbname=PooZoo','root','', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

}catch(PDOException  $ex){
    die('erreur db');
}


?>