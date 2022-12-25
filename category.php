<?php
include "path.php";
include_once ("app/controllers/categories.php");
include 'app/db/connect.php';


$posts = selectAll('posts', ['category_id' => $_GET['id']]); // запрашиваем все посты из нужной нам категории с помощью id в url
rsort($posts)
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

<div class="container-main" xmlns="http://www.w3.org/1999/html">
    <div class="content row">

        <!-- Posts -->
        <div class="main-content col-md-8 col-12">

            <!-- Вывод названия технологии -->
            <?php
                $category = selectOne('categories', ['id' => $_GET['id']]);
            ?>
            <h2><?=$category['name'] . ' :' ;?></h2>

            <?php foreach ($posts as $post): ?>
                <div class="post row">
                    <div class="post-text">
                        <a href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>"><img src="<?=BASE_URL . 'assets/img/posts/' . $post['img'];?>" alt="<?=$post['title'];?>"></a>
                        <h3>
                            <a href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>"><?=mb_substr($post['title'], 0, 200, 'UTF-8');?></a>
                        </h3>
                        <div class="data-icons">
                            <!-- выводим название категории, делая запрос к бд через id -->
                            <?php $category = selectOne('categories', ['id' => $post['category_id']]);?>
                            <span><i class="fa-solid fa-quote-left"></i><?=' '. $category['name'];?></span>

                            <span><i class="far fa-calendar"></i> <?=substr($post['date'], 0, 10)?></span>
                        </div>
                        <p class="preview-text"><?=mb_substr($post['content'], 0, 200, 'UTF-8') . '...';?></p>
                        <div class="icons-block">
                            <div class="icons1">
                                <i class="fa-solid fa-heart like action-icons"></i><span class="value"></span>
                                <i class="fa-solid fa-heart-crack dislike action-icons"></i><span class="value"></span>

                            </div>
                            <div class="icons2">
                                <i class="fa-solid fa-comment action-icons"></i><span class="ajax"></span>
                                <i class="fa-solid fa-share action-icons"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Sidebar -->
        <div class="sidebar col-md-4 col-12">
            <div class="section search">
                <h3>Поиск</h3>
                <form action="/search.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="по сайту">
                </form>
            </div>

            <div class="section topics">
                <h3>Разделы:</h3>
                <ul>
                    <?php foreach ($categories as $key => $category): ?>
                        <li><a href="<?=BASE_URL . 'category.php?id=' . $category['id']; ?> <?=$category['name'];?>"><?=$category['name'];?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include("app/include/footer.php");?>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>


</body>
</html>
