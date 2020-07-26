<?

$localhost = 'localhost';
$name = 'root';
$pass = 'root';
$db_name = 'kartunku';
try{
    $mysql = new PDO('mysql:dbname='.$db_name.'; host='.$localhost.'', $name, $pass,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e){
    exit($e->getMessage());
}



