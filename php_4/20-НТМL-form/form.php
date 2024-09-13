<?php

if (empty($_POST["name"]) or empty($_POST["age"])) {
    // если устривает только одно заполненное поле и полей может быть много, то можно делать проверку только emty(G_POST)
    exit("Одно, либо два поля не заполнены!");
} else {
    $name = htmlspecialchars($_POST["name"]);
    $age = htmlspecialchars($_POST["age"]);
}
echo $name . " " . $age;