<?php
include DIR_ROOT."/app/db/functions.php";

$login = '';
$email = '';
$errMessage = '';

// функция для создания сессий (рефакторинг лютый был проведен)
function sessionStart($arr){

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

$users = selectAll('users');

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
}



//! ADMIN


// мда, с точки зрения ооп это наверное полный пз** (продублировал функцию, только для того, чтобы поменять редирект)
function sessionStart_admin($arr){
    $_SESSION['id'] = $arr['id'];
    $_SESSION['login'] = $arr['username'];
    $_SESSION['admin'] = $arr['admin'];

    header('location:' . BASE_URL . 'admin/users/index.php');
}
//! рег пользователя
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_user'])) { //Переменная $_SERVER - это массив, содержащий информацию, такую как заголовки, пути и местоположения скриптов.

    // получаем данные от юзера и помещаем их в переменные
    $login = trim($_POST['login']); //добавляем функцию trim, для того чтобы убирать все лишние пробелы
    $email = trim($_POST['email']);
    $pass_f = trim($_POST['pass_f']);
    $pass_s = trim($_POST['pass_s']);
    $admin = 0; // также принудительно делаем юзера не админом

    // пишем проверки валидности данных
    if ($login === '' || $email === '' || $pass_f === '') {
        $errMessage = 'Упс, ты заполнил не все поля!';
    } elseif (mb_strlen($login, 'UTF8') < 4) {
        $errMessage = 'Логин не может быть короче 4-x символов.<br> Ну же, время проявить креатив!';
    } elseif (mb_strlen($pass_f, 'UTF-8') < 8) {
        $errMessage = 'Пароль должен быть длиннее 7 символов<br> Для генерации и хранения паролей, советуем программу KeePass2.';
    } elseif ($pass_f !== $pass_s) {
        $errMessage = 'Пароли не совпадают!<br> Для генерации и хранения паролей, советуем программу KeePass2.';
    } else {
        $exCheck = selectOne('users', ['email' => $email]); // проводим проверку на дубликат почты, с помощью функции из functions.php
        if ($exCheck['email'] === $email) { // в $exCheck будет находиться: либо массив с данными из записи в бд, отобранной по соответствию с введенной почтой от юзера
            // либо bool значение - false, в случае, если запись не будет найдена.
            $errMessage = 'Пользователь с такой почтой уже зарегистрирован.';
        } else {
            $hashedPass = password_hash($pass_s, PASSWORD_DEFAULT); // перед тем как поместить в массив, хешируем пароль

            if (isset($_POST['admin'])) $admin = 1; // проверяем массив на чекбоксик

            $postData = [ //создаем массив для аргумента $params
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'pass' => $hashedPass // по итогу в массив передаем уже захешированный пароль
            ];
            $id = insert('users', $postData); // применяем функцию добавления записи из functions.php

            //создание сессии
            $user = selectOne('users', ['id' => $id]);//обращаемся к текущему запросу через его id, которое подтянули из базы
            sessionStart_admin($user); // создаем сессию с помощью функции

        }
    }
}


//! Редактирование (only pass & admin rules)
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])){ // если находим в get запросе строку "id", то:

    // находим необходимый пост по id в бд
    $postArr = selectOne('users', ['id' => $_GET['edit_id']]);
    //и через него подтягиваем всю существующую информацию из бд
    $id = $postArr['id'];
    $admin = $postArr['admin'];
    $login = $postArr['username'];
    $email = $postArr['email'];
}

// Обработка редактирования
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) { //Переменная $_SERVER - это массив, содержащий информацию, такую как: заголовки, пути и местоположения скриптов.
    // получаем данные от юзера и помещаем их в переменные
    $id = $_POST['id'];
    $email = trim($_POST['email']);// ник и мыло принимаю только для дальнейшего вывода в форме, даже после ошибок
    $login = trim($_POST['login']);
    $pass_f = trim($_POST['pass_f']);
    $pass_s = trim($_POST['pass_s']);
    $admin = trim($_POST['admin']);

    // пишем проверки валидности данных
    if ($pass_f === '') {
        $errMessage = 'Ну и чего вообще заходил то тогда';
    } elseif (mb_strlen($pass_f, 'UTF-8') < 8) {
        $errMessage = 'Пароль должен быть длиннее 7 символов<br> Для генерации и хранения паролей, советуем программу KeePass2.';
    } elseif ($pass_f !== $pass_s) {
        $errMessage = 'Пароли не совпадают!<br> Для генерации и хранения паролей, советуем программу KeePass2.';
    } else {
        $hashedPass = password_hash($pass_s, PASSWORD_DEFAULT); // перед тем как поместить в массив, хешируем пароль

        if (isset($_POST['admin'])) $admin = 1;// проверяем массив на чекбоксик
        else $admin = 0;

        $postData = [ //создаем массив для аргумента $params
            'admin' => $admin,
            'pass' => $hashedPass // по итогу в массив передаем уже захешированный пароль
        ];
        $finalId = update('users', $id, $postData); // применяем функцию добавления записи из functions.php
        header('location:' . BASE_URL . 'admin/users/index.php');
    }
}


//! Удаление
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])){ // если находим в get запросе строку "del_id", то:

    $id = $_GET['del_id'];// получаем id выбранного поста
    delete('users', $id);
    header('location: ' . BASE_URL . 'admin/users/index.php' );
}
