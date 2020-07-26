<?php

require_once '../mysql.php';
include '../cheakBd.php';


$login = $_POST['login'];
$pass = $_POST['password'];

$errors = [];

$resLogin = cheakLogin($login, $mysql);


if (!empty($resLogin) AND $resLogin[0]['password'] === $pass)
{
    // авторизипуем
    setcookie('login', $login, time() + 50000, '/');
    setcookie('id', $resLogin[0]['id'], time() + 50000, '/');

    $insert_id = $mysql->lastInsertId();
    $result = [
        'id'=>$insert_id,
        'login' => $login,
    ];
//    header("Location: ../../index.php");
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}
else
{
    $errors[] = 'Ваши данные не верны';
    echo json_encode($errors, JSON_UNESCAPED_UNICODE);
}

