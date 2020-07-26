<?php



function cheakLogin($param, $mysql)
{
    $chLogin = $mysql->prepare("SELECT * FROM register WHERE login=:login");
    $chLogin->execute([
        'login' => $param,
    ]);
    return $resLogin = $chLogin->fetchAll(PDO::FETCH_ASSOC);
}


function cheakEmail($param, $mysql)
{
    $chEmail = $mysql->prepare("SELECT * FROM register WHERE email=:email");
    $chEmail->execute([
        'email' => $param,
    ]);
    return $resEmail = $chEmail->fetchAll(PDO::FETCH_ASSOC);
}


function registerPersone($login, $email, $pass, $mysql)
{
    //запись в register
    $sth = $mysql->prepare("INSERT INTO register SET login = :login, email=:email, password=:pass");
    $sth->execute([
        'login' => $login,
        'email' => $email,
        'pass' => $pass,
    ]);


    $queryLastId= $mysql->prepare("SELECT * FROM register");
    $queryLastId->execute();
    $resLastId = $queryLastId->fetchAll(PDO::FETCH_ASSOC);

    $queryPersone = $mysql->prepare("INSERT INTO infopersone SET id_user=:id_user, name=:name, surname=:surname, image=:image, text=:text");
    $queryPersone->execute([
        'id_user' => end( $resLastId )['id'],
        'name' => '',
        'surname' => '',
        'image' => 'defauld.jpg',
        'text' => '',
    ]);

//    $queryCatalog = $mysql->prepare("INSERT INTO catalotpersone SET id_user=:id_user, image=:image");
//    $queryCatalog->execute([
//        'id_user' => end( $resLastId )['id'],
//        'image' => '',
//    ]);


}
