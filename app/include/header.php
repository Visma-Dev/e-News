<link rel="stylesheet" href="/assets/css/header.css">
<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="<?php echo BASE_URL?>">e-News</a>
                </h1>

            </div>
            <nav class="col-8">
                <ul>
                    <li><a id="href1" href="<?php echo BASE_URL?>">Главная</a></li>
                    <li><a href="#">Последние статьи</a></li>
                    <li><a href="#">Обзоры</a></li>
                    <li>
                        <!-- Альтернативный синтаксис управляющих структур -->
                        <?php if (isset($_SESSION['id'])): ?> <!-- этот блок будет показываться только если пользователь зарегистрирован -->
                            <a href="#">
                                <?php echo $_SESSION['login']; ?> <!-- выводим никнейм -->
                            </a>
                            <ul>
                                <?php if ($_SESSION['admin']): ?> <!-- проверка на админность (базированность) пользователя -->
                                    <li><a href="/admin/posts/index.php"><i class="fa-solid fa-user"></i> Админ панель</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo BASE_URL . "logout.php"; ?>"><!--  --><i class="fa-solid fa-right-from-bracket"></i> Выход</a></li>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo BASE_URL . 'log.php'; ?>">
                                <i class="fa-solid fa-door-open"></i>
                                Войти
                            </a>
                            <ul>
                                <li><a href="<?php echo BASE_URL . 'reg.php'; ?>"><i class="fa-solid fa-right-from-bracket"></i> Регистрация</a></li>
                            </ul>

                        <?php endif; ?>

                    </li>
                </ul>
            </nav>

            <button class="burger" type="button">
                <span class="burger__item"></span>
            </button>
        </div>
    </div>
</header>