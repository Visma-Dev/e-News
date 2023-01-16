<?php include("path.php");
include 'app/controllers/categories.php';
$post = selectOne('posts', ['id' => $_GET['post']]);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= 'e-News - ' . mb_substr($post['title'], 0, 200, 'UTF-8');?></title>


    <!-- Подлкючение бутсрэпа -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Подлкючение font-awesome -->
    <script src="https://kit.fontawesome.com/2fc4dc419e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/single.css">
</head>

<body>
<!-- Header -->
<?php include("app/include/header.php");?>

<!-- Main-block -->
<div class="container-main">
    <div class="content row">

        <!-- Posts -->
        <div class="main-content col-md-8 col-12">
            <h2><?=$post['title'];?></h2>
            <div class="single_post row">
                <div class="post-text">
                    <img src="<?=BASE_URL . 'assets/img/posts/' . $post['img'];?>" alt="<?=$post['title'];?>">
                    <div class="data-icons">
                        <!-- выводим название категории, делая запрос к бд через id -->
                        <?php $category = selectOne('categories', ['id' => $post['category_id']]);?>
                        <span><i class="fa-solid fa-quote-left"></i><?=' '. $category['name'];?></span>

                        <?php $author = selectOne('users', ['id' => $post['author_id']]);?>
                        <span><i class="far fa-user"></i><?=' '. $author['username'];?></span>
                    </div>
                    <p class="preview-text"><?=$post['content']?></p>
                    <div class="icons-block">
                        <div class="icons1">
                            <input hidden name="like" value="<?=$post['id'];?>"><button type="button"><i class="fa-solid fa-heart like action-icons"></i></input></button><span></span>
                            <button name="dislike"><i class="fa-solid fa-heart-crack dislike action-icons"></i></button><span></span>
                            <button><i class="fa-solid fa-comment action-icons"></i></button><span></span>
                        </div>
                        <div class="icons2">
                            <button><i class="fa-solid fa-share action-icons"></i><button>
                        </div>
                    </div>

                    <!-- Комментарии -->
                    <?php  require_once DIR_ROOT . '/app/include/comments.php'; ?>
                </div>
            </div>
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
