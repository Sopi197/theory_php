<?php

require_once 'connect.php';

$login = $_POST['login'];
$email = $_POST['email'];

if (strlen($login) < 5) {
    exit ('Логин слишком короткий, введите логин от 5-ти символов');
}

