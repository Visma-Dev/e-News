<?php
include "app/db/functions.php";

if(isset($_POST['login'])) { // получаем данные от юзера и помещаем их в переменные
    $login = $_POST['login'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass_s'], PASSWORD_DEFAULT); // пароль дополнительно хешируем
    // также принудительно делаем юзера не админом
    $admin = 0;

    $postData = [ //создаем массив для аргумента $params
        'admin' => $admin,
        'username' => $login,
        'email' => $email,
        'pass' => $pass
    ];

    $id = insert('users', $postData); // применяем функцию добавления записи из functions.php
    $row = selectOne('users', ['id' => $id]);
}
