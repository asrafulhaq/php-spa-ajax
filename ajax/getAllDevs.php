<?php

try {
    $connect = new PDO("mysql:host=localhost;dbname=devzone", "root", "root");
} catch (PDOException $error) {
    echo $error->getMessage();
}


$sql = "SELECT * FROM devs";
$statement = $connect->prepare($sql);
$statement->execute();
$data = $statement->fetchAll(PDO::FETCH_OBJ);

$output = "";
foreach ($data as $item) {
    $output .= '<tr>
        <td>1</td>
        <td>' . $item->name . '</td>
        <td>' . $item->age  . '</td>
        <td>' . $item->skill . '</td>
        <td>' . $item->location . '</td>
        <td>
            <button>Edit</button>
            <button class="delete-devs" delete-id="' . $item->id . '">Delete</button>
        </td>
    </tr>';
}

echo $output;
