<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Blog</title>


    <!-- Подлкючение бутсрэпа -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Подлкючение font-awesome -->
    <script src="https://kit.fontawesome.com/2fc4dc419e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/single.css">
</head>

<body>
<!-- Header -->
<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="index.php">e-News</a>
                </h1>

            </div>
            <nav class="col-8">
                <ul>
                    <li><a id="href1" href="#">Главная</a></li>
                    <li><a href="#">Последние статьи</a></li>
                    <li><a href="#">Обзоры</a></li>
                    <li><a href="#">
                        Кабинет

                    </a>
                        <ul>
                            <li><a href="#"><i class="fa-solid fa-user"></i> Админ панель</a></li>
                            <li><a href="#"><i class="fa-solid fa-right-from-bracket"></i> Выход</a></li>
                        </ul>

                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<!-- Main-block -->
<div class="container-main">
    <div class="content row">

        <!-- Posts -->
        <div class="main-content col-md-8 col-12">
            <h2>Утечка: новый Samsung Unpacked пройдёт 10 августа. На нём покажут Galaxy Z Flip 4</h2>
            <div class="single_post row">
                <div class="post-text">
                    <img src="assets/img/post-1.webp" alt="post-photo">
                    <div class="data-icons">
                        <i class="far fa-calendar"> 18 Июля</i>
                        <i class="far fa-user"> Константин Воронин</i>
                    </div>
                    <p class="preview-text">Инсайдер @evleaks опубликовал в Twitter рекламный постер, на котором написано, что следующее мероприятие Samsung Galaxy Unpacked стартует 10 августа 2022 года.</p>
                    <p>На изображении показан новый складной смартфон Galaxy Z Flip 4 в фиолетовом цвете. Но это будет не единственная новинка — на этой же презентации состоится премьера Galaxy Z Fold 4, и, возможно, ещё нескольких устройств, включая умные часы Galaxy Watch 5.</p>
                    <img src="assets/img/post-1(2).jpg">
                    <p>Ранее источники сообщали, что Samsung начнёт принимать предварительные заказы на новые складные смартфоны с 16 августа, а в продажу они якобы поступят в конце месяца.</p>
                    <i class="fa-solid fa-heart like action-icons"></i>
                    <i class="fa-solid fa-heart-crack dislike action-icons"></i>
                    <i class="fa-solid fa-comment action-icons"></i>
                    <i class="fa-solid fa-share action-icons"></i>
                    <!--<div class="share-icons">
                        <i class="fa-solid fa-share"></i>
                    </div>-->
                </div>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="sidebar col-md-4 col-12">
            <div class="section search">
                <h3>Поиск</h3>
                <form action="index.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="по сайту">
                </form>
            </div>

            <div class="section topics">
                <h3>Разделы:</h3>
                <ul>
                    <li><a href="#">Технологии</a></li>
                    <li><a href="#">Кино</a></li>
                    <li><a href="#">Игры</a></li>
                    <li><a href="#">Санкции</a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
<!-- Footer -->
<footer class="container-fluid">
    <div class="row">
        <h3 class="logo">
            <a href="index.php">e-News</a></h3>
        <div class="socials">
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
            <a href="#"><i class="fa-brands fa-vk"></i></a>
            <a href="#"><i class="fa-brands fa-telegram"></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
        </div>
    </div>
    </div>
    <div class="footer-bottom w-100">
        &copy; e-news.com | Designed by VISMA-DEV
    </div>

</footer>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>




</body>
</html>
