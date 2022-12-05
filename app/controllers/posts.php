<?php
include DIR_ROOT."/app/db/functions.php";

$errMessage = '';
$id = '';
$postId = '';
$title = '';
$content = '';
$category = '';
$img = '';
$imgName = '';

$categories = selectAll('categories'); //присваиваем для дальнейшего вывода через цикл в админке и /
$posts = selectAll('posts');

// функция-обработчик фоток
function imgHandler($files){
    $imgName = $files['img']['name'] . "_" . time(); // добавляем метку системного времени Unix для уникализации файлов с идентичным названием.
    $tempDIR = $files['img']['tmp_name'];
    $serverDir = DIR_ROOT."\assets\img\posts\\" . $imgName;

    $result = move_uploaded_file($tempDIR, $serverDir); //Эта функция проверяет, является ли файл загруженным на сервер. Если файл действительно загружен на сервер, он будет перемещён в $serverDir

    if ($result){
        $_POST['img'] = $imgName;
    }else{
        $errMessage = 'Ошибка загрузки изображения на сервер';
    }
}
//! Создание записи (делаем по аналогии с регистрацией юзеров)
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) { //Переменная $_SERVER - это массив, содержащий информацию, такую как: заголовки, пути и местоположения скриптов.

    // получаем данные от юзера и помещаем их в переменные
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $img = trim($_POST['img']);
    $category = $_POST['category'];

    // пишем проверки валидности данных
    if ($title === '' || $content === '' || $category === '') {
        $errMessage = 'Упс, ты заполнил не все поля!';
    }
    elseif (mb_strlen($title, 'UTF8') < 7){
        $errMessage = 'Название статьи не может быть короче 7-и символов.<br> Ну же, время проявить креатив!';
    }
    elseif (($_FILES['img']['error']) === 4){ //Значение: 4; Файл не был загружен.
        $errMessage = "Кажется ты забыл про картинку, а без нее в нашем мире никак :(";
    }
    elseif (strpos($_FILES['img']['type'],'image') === false){ // проверяем с помощью strpos наличие строки 'image'
        $errMessage = "Кажется ты загрузил не картинку, а так делать нельзя :(";
    }
    else{
        $files = $_FILES;
        imgHandler($files);
        $exCheck = selectOne('posts', ['title' => $title]); // проводим проверку на дубликат поста, с помощью функции из functions.php
        if ($exCheck['title'] === $title) {
            $errMessage = 'Запись с таким названием уже существует.';
        }else{

            if (($_POST['add_post']) === 'archive'){ // проводим проверку на нажатие кнопки "в архив"
                $status = 0;
            }
            else{
                $status = 1;
            }

            $postData = [ //создаем массив для аргумента $params
                'author_id' => $_SESSION['id'], // id подтягиваем напрямую из сессии
                'title' => $title,
                'img' => $_POST['img'],
                'content' => $content,
                'category_id' => $category,
                'status' => $status
            ];

            $finalId = insert('posts', $postData); // применяем функцию добавления записи из functions.php

            // после успешно созданной категории редирект на страницу управления постами
            header('location: ' . BASE_URL . 'admin/posts/index.php' );
        }
    }
}


//! Редактирование
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){ // если находим в get запросе строку "id", то:

    // находим необходимый пост по id в бд
    $postArr = selectOne('posts', ['id' => $_GET['id']]);

    //и через него подтягиваем всю существующую информацию из бд
    $id = $postArr['id'];
    $title = $postArr['title'];
    $content = $postArr['content'];
    $img = $postArr['img'];
    $category_id = $postArr['category_id'];
    $category_arr = selectOne('categories', ['id' => $category_id]);
    $status = $postArr['status'];
}

// Обработка редактирования
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) { //Переменная $_SERVER - это массив, содержащий информацию, такую как: заголовки, пути и местоположения скриптов.

    // получаем данные от юзера и помещаем их в переменные
    $id = trim($_POST['id']);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $img = trim($_POST['img']);
    $category = trim($_POST['category']);
    $status = trim($_POST['status']);

    // пишем проверки валидности данных
    if ($title === '' || $content === '' || $category === '') {
        $errMessage = 'Упс, ты заполнил не все поля!';
    } elseif (mb_strlen($title, 'UTF8') < 7) {
        $errMessage = 'Название статьи не может быть короче 7-и символов.<br> Ну же, время проявить креатив!';
    } elseif (($_FILES['img']['error']) === 4) { //Значение: 4; Файл не был загружен.
        $errMessage = "Кажется ты забыл про картинку, а без нее в нашем мире никак :(";
    } elseif (strpos($_FILES['img']['type'], 'image') === false) { // проверяем с помощью strpos наличие строки 'image'
        $errMessage = "Кажется ты загрузил не картинку, а так делать нельзя :(";
    } else {
        //обработчик изображения
        $files = $_FILES;
        imgHandler($files);

        if (($_POST['edit_post']) === 'archive') { // проводим проверку на нажатие кнопки "в архив"
            $status = 0;
        } else {
            $status = 1;
        }

        $postData = [ //создаем массив для аргумента $params
            'author_id' => $_SESSION['id'], // id автора подтягиваем напрямую из сессии
            'title' => $title,
            'img' => $_POST['img'],
            'content' => $content,
            'category_id' => $category,
            'status' => $status
        ];

        $finalId = update('posts', $id, $postData); // применяем функцию добавления записи из functions.php

        // после успешно созданной категории редирект на страницу управления постами
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
}

//! Архив
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['stat_id'])) { // если находим в get запросе строку "del_id", то:

    $id = $_GET['stat_id'];// получаем id выбранного поста
    $status = $_GET['status'];

    $finalId = update('posts', $id, ['status' => $status]);

    header('location: ' . BASE_URL . 'admin/posts/index.php');
}
//! Удаление
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])){ // если находим в get запросе строку "del_id", то:

    $id = $_GET['del_id'];// получаем id выбранного поста
    delete('posts', $id);
    header('location: ' . BASE_URL . 'admin/posts/index.php' );
}