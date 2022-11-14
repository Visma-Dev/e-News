<?php

include "../../app/db/functions.php";

$errMessage = '';
$id = '';
$name = '';
$description = '';

$categories = selectAll('categories');

//! Создание категории (делаем по аналогии с регистрацией юзеров)
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) { //Переменная $_SERVER - это массив, содержащий информацию, такую как: заголовки, пути и местоположения скриптов.

    // получаем данные от юзера и помещаем их в переменные
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    // пишем проверки валидности данных
    if ($name === '' || $description === '') {
        $errMessage = 'Упс, ты заполнил не все поля!';
    }
    elseif (mb_strlen($name, 'UTF8') < 2){
        $errMessage = 'Название категории не может быть короче 2-x символов.<br> Ну же, время проявить креатив!';
    }
    else{
        $exCheck = selectOne('categories', ['name' => $name]); // проводим проверку на дубликат категории, с помощью функции из functions.php
        if ($exCheck['name'] === $name) {
            $errMessage = 'Категория с таким названием уже существует.';
        }else{
            $postData = [ //создаем массив для аргумента $params
                'name' => $name,
                'description' => $description
            ];
            $id = insert('categories', $postData); // применяем функцию добавления записи из functions.php

            // после успешно созданной категории редирект на страницу управления категориями
            header('location: ' . BASE_URL . 'admin/categories/index.php' );
        }
    }
}


//! Редактирование
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){ // если находим в get запросе строку "id", то:

    // получаем id выбранной категории
    $id = $_GET['id'];
    $categoryArr = selectOne('categories', ['id' => $id]);

    //и через него подтягиваем всю существующую информацию из бд
    $id = $categoryArr['id'];
    $name = $categoryArr['name'];
    $description = $categoryArr['description'];

}

// Обработка редактирования
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) { //Переменная $_SERVER - это массив, содержащий информацию, такую как: заголовки, пути и местоположения скриптов.

    // получаем данные от юзера и помещаем их в переменные
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    // пишем проверки валидности данных
    if ($name === '' || $description === '') {
        $errMessage = 'Упс, ты заполнил не все поля!';
    }
    elseif (mb_strlen($name, 'UTF8') < 2){
        $errMessage = 'Название категории не может быть короче 2-x символов.<br> Ну же, время проявить креатив!';
    }
    else{
    $postData = [ //создаем массив для аргумента $params
        'name' => $name,
        'description' => $description,
    ];

    $id = $_POST['id'];
    $categoryId = update('categories', $id, $postData); // применяем функцию добавления записи из functions.php

    // после успешно отредактированной категории редирект на страницу управления категориями
    header('location: ' . BASE_URL . 'admin/categories/index.php' );
    }
}


//! Удаление
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])){ // если находим в get запросе строку "del_id", то:

    // получаем id выбранной категории
    $id = $_GET['del_id'];
    delete('categories', $id);
    header('location: ' . BASE_URL . 'admin/categories/index.php' );
}