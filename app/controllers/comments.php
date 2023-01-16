<?php

$postId = $_GET['post'];
$userId = $_POST['userId'];
$content = $_POST['content'];
$comments = selectAll('comments', ['postId'  =>  $postId]);


//! Создание коммента
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {

    // получаем данные от юзера и помещаем их в переменные
    $content = trim($_POST['content']);

    // пишем проверки валидности данных
    if ($content === '') {
        $errMessage = 'Ну что-же, спасибо за пустоту...';
    }
    elseif ($userId === '') {
        $errMessage = 'Пожалуйста, <a href="/log.php">авторизуйтесь</a>.<br><br>„ Глупо искать выход из безвыходного положения, если все еще стоишь перед входом… “ ';
    }
    else{
        $postData = [ //создаем массив для аргументов $params
            'postId' => $postId,
            'userId' => $userId,
            'content' => $content,
        ];

        $finalId = insert('comments', $postData); // применяем функцию добавления записи из functions.php
        $comments = selectAll('comments', ['postId'  =>  $postId]);
    }
}

//! Удаление
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['comm_id'])){ // если находим в get запросе строку "comm_id", то:

    $id = $_GET['comm_id'];// получаем id выбранного поста
    delete('comments', $id);
    $comments = selectAll('comments', ['postId'  =>  $postId]);
}



