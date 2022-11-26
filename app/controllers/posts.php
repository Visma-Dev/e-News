<?php
include DIR_ROOT."/app/db/functions.php";

$errMessage = '';
$id = '';
$title = '';
$content = '';
$category = '';
$img = '';

$categories = selectAll('categories'); //присваиваем для дальнейшего вывода через цикл в админке и /
$posts = selectAll('posts');

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
        //обработчик изображения
        if (($_FILES['img']['error']) === 0){

            $imgName = $_FILES['img']['name'] . "_" . time(); // добавляем метку системного времени Unix для уникализации файлов с идентичным названием.
            $tempDIR = $_FILES['img']['tmp_name'];
            $serverDir = DIR_ROOT."\assets\img\posts\\" . $imgName;

            $result = move_uploaded_file($tempDIR, $serverDir); //Эта функция проверяет, является ли файл загруженным на сервер. Если файл действительно загружен на сервер, он будет перемещён в $serverDir

            if ($result){
                $_POST['img'] = $imgName;
            }else{
                $errMessage = 'Ошибка загрузки изображения на сервер';
            }
        }

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
                'img' => $img,
                'content' => $content,
                'category_id' => $category,
                'status' => $status
            ];

            $id = insert('posts', $postData); // применяем функцию добавления записи из functions.php

            // после успешно созданной категории редирект на страницу управления категориями
            header('location: ' . BASE_URL . 'admin/posts/index.php' );
        }
    }
}


//! Редактирование
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['update_id'])){ // если находим в get запросе строку "id", то:

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

    $id = $_GET['del_id'];// получаем id выбранной категории
    delete('categories', $id);
    header('location: ' . BASE_URL . 'admin/categories/index.php' );
}