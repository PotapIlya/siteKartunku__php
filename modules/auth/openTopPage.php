<?

include '../mysql.php';

$image = $_POST['item'];

$queryPict = $mysql->prepare("SELECT * FROM catalotpersone WHERE image=:image");
$queryPict->execute([
    'image' => $image
]);
$resBox = $queryPict->fetchAll(PDO::FETCH_ASSOC);


$queryComments= $mysql->prepare("SELECT * FROM comment WHERE image=:image");
$queryComments->execute([
    'image' => $image
]);
$resCommentsq = $queryComments->fetchAll(PDO::FETCH_ASSOC);




$result = [
    'id' => $resBox[0]['id'],
    'id_user' => $resBox[0]['id_user'],
    'image' => $resBox[0]['image'],
    'description' => $resBox[0]['description'],
    'text' => $resCommentsq[0]['text'],
];


echo json_encode($result, JSON_UNESCAPED_UNICODE);