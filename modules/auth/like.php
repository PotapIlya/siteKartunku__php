<?php

include '../mysql.php';

$id = $_POST['id'];

$queryCheak = $mysql->prepare("SELECT * FROM likes WHERE is_user=:is_user AND is_post=:is_post");
$queryCheak->execute([
    'is_user' => $_COOKIE['id'],
    'is_post'=> $id,
]);
$resCheak = $queryCheak->fetchAll(PDO::FETCH_ASSOC);

if (empty($resCheak))
{
    $query = $mysql->prepare("INSERT INTO likes SET is_user=:is_user, is_post=:is_post, status=:status");
    $query->execute([
        'is_user' => $_COOKIE['id'],
        'is_post'=> $id,
        'status' => 1,
    ]);
}

$queryPersone = $mysql->prepare("SELECT is_user FROM likes WHERE is_post=:is_post");
$queryPersone->execute([
    'is_post' => $id,
]);
$queryRes = $queryPersone->fetchAll(PDO::FETCH_ASSOC);


$result = [
  'id' => $id,
  'user' => $_COOKIE['id'],
    'likes' => count($queryRes),
];

echo json_encode($result, JSON_UNESCAPED_UNICODE);