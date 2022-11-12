<?php include("../../path.php");
include '../../app/db/connect.php';

session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-News - Админ Панель</title>


    <!-- Подлкючение бутсрэпа -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Подлкючение font-awesome -->
    <script src="https://kit.fontawesome.com/2fc4dc419e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>

<body>
<!-- Header -->
<?php include("../../app/include/header-admin.php");?>

<!-- Разметка админки -->
<div class="container">
    <div class="row">
        <?php include '../../app/include/sidebar-admin.php';?>
        <div class="col-1"></div>
        <!-- Статьи -->
        <div class="posts col-8">
            <h1>Управление статьями:</h1>
            <div class="buttons row col-5">
                <a href="create.php" class="col-4 btn btn-create">Создать</a>
                <a href="index.php" class="col-4 btn btn-manage">Управление</a>
            </div>
            <div class="row title-table">
                <div class="id col-1">id</div>
                <div class="title col-5">Название</div>
                <div class="author col-2">Автор</div>
                <div class="col-4">Изменение</div>
            </div>
            <div class="row post">
                <div class="id col-1">1</div>
                <div class="title col-5">Мажевеленик... Враг в отражении</div>
                <div class="author col-2">Артем Курочкин</div>
                <div class="edit col-2">Редакт.</div>
                <div class="del col-2">Удалить</div>
            </div>
            <div class="row post">
                <div class="id col-1">1</div>
                <div class="title col-5">Мажевеленик... Враг в отражении</div>
                <div class="author col-2">Артем Курочкин</div>
                <div class="edit col-2">Редакт.</div>
                <div class="del col-2">Удалить</div>
            </div>
            <div class="row post">
                <div class="id col-1">1</div>
                <div class="title col-5">Мажевеленик... Враг в отражении</div>
                <div class="author col-2">Артем Курочкин</div>
                <div class="edit col-2">Редакт.</div>
                <div class="del col-2">Удалить</div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include("../../app/include/footer.php");?>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</body>
</html>
