<?php

require_once '../mysql.php';
include '../cheakBd.php';

//$login = $_POST['data_0'];
//$email = $_POST['data_1'];
//$pass = $_POST['data_2'];

$login = $_POST['login'];
$email = $_POST['email'];
$pass = $_POST['password'];

$errors = [];

if ($login !== '' && $email !== '' && $pass !== '' )
{

    //login
    $resLogin = cheakLogin($login, $mysql);
    if (!empty($resLogin))
    {
        $errors[] = 'Такой Логин уже существует';
    }

    //email
    $resEmail = cheakEmail($email, $mysql);
    if (!empty($resEmail))
    {
        $errors[] = 'Такой E-mail уже существует';
    }

    if (empty($errors))
    {
//      full ok
        registerPersone($login, $email, $pass, $mysql);

        $insert_id = $mysql->lastInsertId();
        $result = [
            'id'=>$insert_id,
            'login' => $login,
            'email' => $email,
            'pass' => $pass,
        ];
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
    else
    {
        //errors
        echo json_encode($errors, JSON_UNESCAPED_UNICODE);
    }
}





