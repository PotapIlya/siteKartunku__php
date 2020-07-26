<?php
require_once '../mysql.php';

$comment = $_POST['comment'];
$id_post = $_POST['id'];


if (isset($comment))
{
    $query = $mysql->prepare("INSERT INTO comment SET id_user=:id_user, id_post=:id_post, text=:text");
    $query->execute([
        'id_user' => $_COOKIE['id'],
        'id_post' => $id_post,
        'text' => $comment,
    ]);
    $result = [
        'user' => $_COOKIE['id'],
        'id_post' => $id_post,
        'text' => $comment,
    ];

    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}
else
{
    echo json_encode('Пустая строка', JSON_UNESCAPED_UNICODE);
}






