<?php
    include("../../path.php");
    include "../../app/controllers/posts.php";
    rsort($posts);
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
        <div class="posts col-9">
            <h1>Управление статьями:</h1>
            <div class="buttons row col-5">
                <a href="create.php" class="col-4 btn btn-create">Создать</a>
            </div>
            <div class="row title-table">
                <div class="id col-1">id</div>
                <div class="title col-3">Название</div>
                <div class="author col-2">Дата</div>
                <div class="col-6">Изменение</div>
            </div>
            <div class="row post">
                <?php foreach ($posts as $key => $post): ?>
                <div class="id col-1"><?=$post['id'];?></div>
                <div class="title col-3"><?=$post['title'];?></div>
                <div class="author col-2"><?=$post['date'];?></div>

                <div class="act edit col-1"><a href="edit.php?id=<?=$post['id'];?>"><i class="fa-solid fa-pencil"></i></a></div>
                <div class="act del col-1"><a href="edit.php?del_id=<?=$post['id'];?>"><i class="fa-solid fa-trash"></i></a></div>
                <?php if ($post['status']): ?> <!-- Проверяем значение перед выводом статуса -->
                    <div class="act archive col-2" name="add_post" value="archive"  type="submit"><a href="edit.php?status=0&stat_id=<?=$post['id'];?>">В архив</a></div>
                <?php else: ?>
                        <div class="act archive col-2"><a href="edit.php?status=1&stat_id=<?=$post['id'];?>">Вернуть из архива</a></div>
                <?php endif; ?>

                <?php if ($post['slider'] == 0): ?>
                    <div class="act slider col-2" name="add_post" value="slider" type="submit"><a href="edit.php?slider=1&slide_id=<?=$post['id'];?>">Добавить в слайдер</a></div>
                <?php else: ?>
                    <div class="act slider col-2"><a href="edit.php?slider=0&slide_id=<?=$post['id'];?>">Удалить из слайдера</a></div>
                <?php endif; ?>

                <?php endforeach;?>
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
