<?php
include "app/db/functions.php";
include "path.php";

$errMessage = '';

// функция для создания сессий (рефакторинг лютый был проведен)
function sessionStart($arr){
    //задаем значения супер-глобальному массиву $_SESSION, предварительно обращаясь к текущему запросу через его id
    $_SESSION['id'] = $arr['id'];
    $_SESSION['login'] = $arr['username'];
    $_SESSION['admin'] = $arr['admin'];

    if ($_SESSION['admin']){
        header('location:' . BASE_URL . 'admin/posts/index.php');
    }else{
        // редирект на главную
        header('location: ' . BASE_URL );
    }

}


//! обработчик регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_reg'])) { //Переменная $_SERVER - это массив, содержащий информацию, такую как заголовки, пути и местоположения скриптов.
    // получаем данные от юзера и помещаем их в переменные
    $login = trim($_POST['login']); //добавляем функцию trim, для того чтобы убирать все лишние пробелы
    $email = trim($_POST['email']);
    $pass_f = trim($_POST['pass_f']);
    $pass_s = trim($_POST['pass_s']);
    $admin = 0; // также принудительно делаем юзера не админом

    // пишем проверки валидности данных
    if ($login === '' || $email === '' || $pass_f === '') {
        $errMessage = 'Упс, ты заполнил не все поля!';
    }
    elseif (mb_strlen($login, 'UTF8') < 4){
        $errMessage = 'Логин не может быть короче 4-x символов.<br> Ну же, время проявить креатив!';
    }
    elseif (mb_strlen($pass_f, 'UTF-8') < 8){
    $errMessage = 'Пароль должен быть длиннее 7 символов<br> Для генерации и хранения паролей, советуем программу KeePass2.';
    }
    elseif ($pass_f !== $pass_s) {
        $errMessage = 'Пароли не совпадают!<br> Для генерации и хранения паролей, советуем программу KeePass2.';
    }
    else{
        $exCheck = selectOne('users', ['email' => $email]); // проводим проверку на дубликат почты, с помощью функции из functions.php
        if ($exCheck['email'] === $email) { // в $exCheck будет находиться: либо массив с данными из записи в бд, отобранной по соответствию с введенной почтой от юзера
                                            // либо bool значение - false, в случае, если запись не будет найдена.
            $errMessage = 'Пользователь с такой почтой уже зарегистрирован.';
        }else{
            $hashedPass = password_hash($pass_s, PASSWORD_DEFAULT); // перед тем как поместить в массив, хешируем пароль
            $postData = [ //создаем массив для аргумента $params
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'pass' => $hashedPass // по итогу в массив передаем уже захешированный пароль
            ];
            $id = insert('users', $postData); // применяем функцию добавления записи из functions.php

            //создание сессии
            $user = selectOne('users', ['id' => $id]);//обращаемся к текущему запросу через его id, которое подтянули из базы
            sessionStart($user); // создаем сессию с помощью функции

        }
    }

}else{//GET
    // инициализируем переменные при get запросе, чтобы в случае ошибки проверки валидации, пользователю не нужно было вводить эти значения заново
    $login = '';
    $email = '';
}


//! обработчик авторизации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_log'])) { // здесь проверяем тип кнопки, которую прожал юзер, если с формы регистрации, то отправляем на обработчик регистрации, если из входа, то переходим к этому коду ↓

    $email = trim($_POST['email']); //добавляем функцию trim, для того чтобы убирать все лишние пробелы
    $pass = trim($_POST['pass']);

    // пишем проверки валидности данных
    if ($email === '' || $pass === '') {
        $errMessage = 'Упс, ты заполнил не все поля!';
    }
    else{
        $exCheck = selectOne('users', ['email' => $email]);
        if ($exCheck && password_verify($pass, $exCheck['pass'])){ // password_verify — Проверяет, соответствует ли пароль хешу
            sessionStart($exCheck); // Старт сессии
        }else{
            $errMessage = 'Ошибка входа, проверь введенные данные.';
        }
    }
}else{//GET
    // инициализируем переменные при get запросе, чтобы в случае ошибки проверки валидации, пользователю не нужно было вводить эти значения заново
    $email = '';
}


