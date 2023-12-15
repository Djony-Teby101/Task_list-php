<?php

$host="localhost";
$name="root";
$pass="";
$dbname="todolist";

try {
    $conn=new PDO("mysql:host=$host;dbname=$dbname",$name,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

} catch (PDOException $e) {
    die("Erreur:"." ". $e->getMessage());
}


?>