<?php
//
//
//function image($fileName, $fileSize, $fileTnp, $mysql)
//{
//    $errors = [];
//
//    if ($fileSize > 3145728) {
//        $errors[] = 'Размер НЕ более 3 мб';
//    }
//
//    $checkArray = ['jpg', 'jpeg', 'png', 'svg'];
//    $nameFile = explode('.', $fileName);
//    $check = in_array(end($nameFile), $checkArray);
//    if ($check != 1){
//        $errors[] = 'Не тот тип фаила';
//    }
//
//
//    if (empty($errors))
//    {
//        $queryUpload = $mysql->prepare("SELECT image FROM infopersone WHERE id_user=:id_user");
//        $queryUpload->execute([
//            'id_user' => $_COOKIE['id'],
//        ]);
//        $resUpload = $queryUpload->fetchAll(PDO::FETCH_ASSOC);
//
//        if (file_exists('../../../uploads/users/' . $_COOKIE['id'] . '/' . $resUpload[0]['image']) === true) {
//            //есть
//            unlink('../../../uploads/users/'.$_COOKIE['id'].'/'.$resUpload[0]['image']);
//        }
//
//        // random name file
//        $nameFile = mt_rand() . '.' . end($nameFile);
//
//        $queryUpdate = $mysql->prepare("UPDATE infopersone SET image=:image WHERE id_user=:id_user");
//        $queryUpdate->execute([
//            'image' => $nameFile,
//            'id_user' => $_COOKIE['id'],
//        ]);
//
//        move_uploaded_file($fileTnp,'../../../uploads/users/' . $_COOKIE['id'] . '/' . $nameFile);
//
//        return json_encode('Картинка обновлена', JSON_UNESCAPED_UNICODE);
//    }
//
//    else {
//        return json_encode($errors, JSON_UNESCAPED_UNICODE);
//    }
//
//
//}