<?php

    require_once '../../mysql.php';
    require_once '../../cheakBd.php';

$login = $_POST['login'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];
$text = $_POST['text'];

$errors = [];

$fileName = $_FILES['image']['name'];
$fileSize = $_FILES['image']['size'];
$fileTnp = $_FILES['image']['tmp_name'];

//$login = $_POST['data_0'];
//$name = $_POST['data_1'];
//$surname = $_POST['data_2'];
//$email = $_POST['data_3'];
//$password = $_POST['data_4'];

//$errors = [];


//$fileName = $_FILES['data_5']['name'];
//$fileSize = $_FILES['data_5']['size'];
//$fileTnp = $_FILES['data_5']['tmp_name'];





$cheakBd = $mysql->prepare("SELECT * FROM register WHERE id!=:id");
$cheakBd->execute([
    'id' => $_COOKIE['id'],
]);
$resCheak = $cheakBd->fetchAll(PDO::FETCH_ASSOC);


foreach ($resCheak as $val)
{
    if ($login === $val['login'])
    {
        $errors[] = 'Данный Логин занят';
    }
}
foreach ($resCheak as $val)
{
    if ($email === $val['email'])
    {
        $errors[] = 'Данный Email занят';
    }
}
if (empty($errors))
{
     // обновление в register
    $queryRegister = $mysql->prepare("UPDATE register SET login=:login, email=:email, password=:password WHERE id=:id");
    $queryRegister->execute([
        'login' => $login,
        'email' => $email,
        'password' => $password,
        'id' => $_COOKIE['id'],
    ]);

    // обновление в infopersone
    $queryPersone = $mysql->prepare("UPDATE infopersone SET name=:name, surname=:surname, text=:text WHERE id_user=:id_user");
    $queryPersone->execute([
        'name' => $name,
        'surname' => $surname,
        'text' => $text,
        'id_user' => $_COOKIE['id'],
    ]);




    //image
    if ($fileName !== '')
    {
        if (!file_exists('../../../uploads/users/'.$_COOKIE['id']))
        {
            mkdir('../../../uploads/users/'.$_COOKIE['id']);
        }
        $image = image($fileName, $fileSize, $fileTnp, $mysql);
    }
    $result = [
        'login' => $login,
        'name' =>  $name,
        'surname' => $surname,
        'email' => $email,
        'text' => $text,
        'image' => $image,
    ];


    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}
else
{
    echo json_encode($errors, JSON_UNESCAPED_UNICODE);
}





function image($fileName, $fileSize, $fileTnp, $mysql)
{
    $errors = [];

    if ($fileSize > 3145728) {
        $errors[] = 'Размер НЕ более 3 мб';
    }

    $checkArray = ['jpg', 'jpeg', 'png', 'svg'];
    $nameFile = explode('.', $fileName);
    $check = in_array(end($nameFile), $checkArray);
    if ($check != 1){
        $errors[] = 'Не тот тип фаила';
    }


    if (empty($errors))
    {
        $queryUpload = $mysql->prepare("SELECT image FROM infopersone WHERE id_user=:id_user");
        $queryUpload->execute([
            'id_user' => $_COOKIE['id'],
        ]);
        $resUpload = $queryUpload->fetchAll(PDO::FETCH_ASSOC);

        if (file_exists('../../../uploads/users/' . $_COOKIE['id'] . '/' . $resUpload[0]['image']) === true) {
            //есть
            unlink('../../../uploads/users/'.$_COOKIE['id'].'/'.$resUpload[0]['image']);
        }

        // random name file
        $nameFile = mt_rand() . '.' . end($nameFile);

        $queryUpdate = $mysql->prepare("UPDATE infopersone SET image=:image WHERE id_user=:id_user");
        $queryUpdate->execute([
            'image' => $nameFile,
            'id_user' => $_COOKIE['id'],
        ]);

        move_uploaded_file($fileTnp,'../../../uploads/users/' . $_COOKIE['id'] . '/' . $nameFile);



        return json_encode($nameFile, JSON_UNESCAPED_UNICODE);
    }

    else {
        return json_encode($errors, JSON_UNESCAPED_UNICODE);
    }


}
