<?php

require_once '../../mysql.php';

$description = $_POST['description'];
$fileName = $_FILES['image']['name'];
$fileSize = $_FILES['image']['size'];
$fileTnp = $_FILES['image']['tmp_name'];



$errors = [];

if (!empty($description) AND $_FILES === '')
{
    $errors[] = 'Вы не выбрали картинку';
}


if ($fileSize > 3145728) {
    $errors[] = 'Размер НЕ более 3 мб';
}

$checkArray = ['jpg', 'jpeg', 'png', 'svg'];
$nameFile = explode('.', $fileName);
$check = in_array(end($nameFile), $checkArray);
if ($check != 1) {
    $errors[] = 'Не тот тип фаила';
}



if (empty($errors)) {
    if (!file_exists('../../../uploads/users/'.$_COOKIE['id']))
    {
        mkdir('../../../uploads/users/'.$_COOKIE['id']);
    }

    // random name file
    $nameFile = mt_rand() . '.' . end($nameFile);

    $queryUpdate = $mysql->prepare("INSERT INTO catalotpersone SET id_user=:id_user, image=:image, description=:description");
    $queryUpdate->execute([
        'id_user' => $_COOKIE['id'],
        'image' => $nameFile,
        'description' => $description,
    ]);

    move_uploaded_file($fileTnp, '../../../uploads/users/' . $_COOKIE['id'] . '/' . $nameFile);

    $result = [
      'name' => $nameFile,
        'id' => $_COOKIE['id'],
        'description' => $description,
    ];

    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}
else
{
    echo json_encode($errors, JSON_UNESCAPED_UNICODE);
}
