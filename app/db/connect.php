<?php
session_start();

$driver = "mysql";
$host = "127.0.0.1";
$db_name = "e-news";
$db_user = "root";
$db_pass = "root";
$charset = "utf8";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // базовые атрибуты pdo для обработки ошибок
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]; // атрибут для выбора вида возвращаемого массива. В данном случае, выбрали ассоциативный.


try{
    $pdo = new PDO(
        "$driver:host=$host;dbname=$db_name;charset=$charset",
        $db_user, $db_pass, $options
    );
}catch (PDOException $i){
    die("Ошибка подлкючения к базе данных");
}