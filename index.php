<?php
include "path.php";
include 'app/db/functions.php';
include 'app/db/connect.php';

$sliderPosts = selectAll('posts', ['slider' => 1]); // заносим все слайдерные посты в переменную
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-News - Все самые свежие новости из мира IT</title>

    <link type="image/x-icon" href="assets/img/fav.jpg" rel="shortcut icon">
    <link type="Image/x-icon" href="assets/img/fav.jpg" rel="icon">



    <!-- Подключение бутсрэпа -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Подключение font-awesome -->
    <script src="https://kit.fontawesome.com/2fc4dc419e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
<!-- Header -->
<?php include("app/include/header.php");?>

<!--Carousel-->
<div class="container">
    <div class="row">
        <h2 class="carousel-title"></h2>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-inner">
                <?php foreach ($sliderPosts as $key => $post):?> <!-- Выводим посты с помощью цикла -->
                    <?php if($key == 0):?> <!-- Класс active даем только первому слайду -->
                    <div class="carousel-item active">
                    <?php else:?>
                    <div class="carousel-item">
                    <?php endif;?>
                        <img src="<?=BASE_URL . 'assets/img/posts/' . $post['img'];?>" alt="<?=$post['title'];?>" class="d-block w-100">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><a href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>"><?=mb_substr($post['title'], 0, 200, 'UTF-8');?></a></h5>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Main-block -->
<?php include "app/include/recent.php"?>

<!-- Footer -->
<?php include("app/include/footer.php");?>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</body>
</html>
