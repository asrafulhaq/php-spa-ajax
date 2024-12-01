<?php

$id = $_GET['deleteId'];

try {
    $connect = new PDO("mysql:host=localhost;dbname=devzone", "root", "root");
} catch (PDOException $error) {
    echo $error->getMessage();
}


$sql = "DELETE FROM devs WHERE id='$id'";
$statement = $connect->prepare($sql);
$statement->execute();
