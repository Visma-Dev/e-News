<?php
    include("../../path.php");
    include '../../app/db/connect.php';

    include_once "../../app/controllers/categories.php";
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
        <!-- Категории -->
        <div class="posts col-8">
            <h1>Управление категориями:</h1>
            <div class="buttons row col-5">
                <a href="create.php" class="col-4 btn btn-create">Добавить</a>
            </div>
            <!-- заголовки разделов -->
            <div class="row title-table">
                <div class="id col-1">id</div>
                <div class="title col-5">Название</div>
                <div class="col-4">Изменение</div>
            </div>
            <!-- вывод категорий из бд через цикл -->
            <?php foreach ($categories as $key => $category): ?>
            <div class="row post">
                <div class="id col-1"><?=$key + 1; ?></div> <!-- к id прибавляем 1, т.к. в массиве список id начинается с 0 -->
                <div class="title col-5"><?=$category['name'];?></div>
                <div class="act edit col-2"><a href="edit.php?id=<?=$category['id'];?>">Редакт.</a></div>
                <div class="act del col-2"><a href="edit.php?del_id=<?=$category['id'];?>">Удалить</a></div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include("../../app/include/footer.php");?>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</body>
</html>
