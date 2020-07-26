<?php
require_once '../../mysql.php';



$idImage = $_POST['image'];

$deleteItem = $mysql->prepare("DELETE FROM catalotpersone WHERE id_user=:id_user AND image=:image");
$deleteItem->execute([
    'id_user' => $_COOKIE['id'],
    'image' => $idImage,
]);
unlink('../../../uploads/users/'.$_COOKIE['id'].'/'.$idImage);


$res = [
    'Удалено'
];

echo json_encode($idImage, JSON_UNESCAPED_UNICODE);