<?php
include ("app/controllers/categories.php");

$posts = selectAll('posts', ['status' => 1]);//выводим все посты, кроме архивных.
?>

<div class="container-main">
    <div class="content row">

        <!-- Posts -->
        <div class="main-content col-md-8 col-12">
            <h2>Последние:</h2>
            <?php foreach ($posts as $post): ?>
                <div class="post row">
                    <div class="post-text">
                        <a href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>"><img src="<?=BASE_URL . 'assets/img/posts/' . $post['img'];?>" alt="<?=$post['title'];?>"></a>
                        <h3>
                            <a href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>"><?=mb_substr($post['title'], 0, 200, 'UTF-8');?></a>
                        </h3>
                        <div class="data-icons">
                            <i class="far fa-calendar"> <?=substr($post['date'], 0, 10)?></i>
                            <!-- выводим имя автора, делая запрос к бд через id -->
                            <?php $author = selectOne('users', ['id' => $post['author_id']]);?>
                            <i class="far fa-user"><?=' '. $author['username'];?></i>
                        </div>
                        <p class="preview-text"><?=mb_substr($post['content'], 0, 200, 'UTF-8') . '...';?></p>
                        <i class="fa-solid fa-heart like action-icons"></i>
                        <i class="fa-solid fa-heart-crack dislike action-icons"></i>
                        <i class="fa-solid fa-comment action-icons"></i>
                        <i class="fa-solid fa-share action-icons"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Sidebar -->
        <div class="sidebar col-md-4 col-12">
            <div class="section search">
                <h3>Поиск</h3>
                <form action="recent.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="по сайту">
                </form>
            </div>

            <div class="section topics">
                <h3>Разделы:</h3>
                <ul>
                    <?php foreach ($categories as $key => $category): ?>
                    <li><a href="#"><?=$category['name'];?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>