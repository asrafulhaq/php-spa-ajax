<?php

try {
    $connect = new PDO("mysql:host=localhost;dbname=devzone", "root", "root");
} catch (PDOException $error) {
    echo $error->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get form data 
    $name = $_POST['name'];
    $age = $_POST['age'];
    $skill = $_POST['skill'];
    $location = $_POST['location'];

    $sql = "INSERT INTO devs (name, age, skill, location) VALUES (? ,?, ?, ?)";
    $statement = $connect->prepare($sql);
    $statement->execute([$name, $age, $skill, $location]);
}
