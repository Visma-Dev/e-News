<?php

$posts = selectAll('posts', ['status' => 1]);//выводим все посты, кроме архивных.
rsort($posts);
?>

<div class="container-main" xmlns="http://www.w3.org/1999/html">
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
            <!-- Ajax запрос для обработки лайков/дизов -->
            <!--<script type="text/javascript">
                const dd = document;
                let blocks = dd.querySelectorAll(".j");
                let url = 'app/controllers/ajax.php'

                function ajax (data, url, objectClass){
                    let param = 'data=' + data
                    let request = new XMLHttpRequest();
                    request.open ('POST', url, true);
                    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    request.send(param)
                    request.addEventListener('readystatechange', () => {
                        if (request.readyState === 4 && request.status === 200) {
                            dd.querySelector(objectClass).innerHTML = request.responseText
                        }
                    })
                }
                for (let i = 0; i < blocks.length; i++) {
                    let data = blocks[i].getAttribute('ajax')
                    blocks[i].onclick = () => {
                        ajax(data, url, '.value')
                    }
                }
            </script>-->

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
                    <li><a href="#"><?=$category['name'];?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>