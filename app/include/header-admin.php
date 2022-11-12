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
                    <li>
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <?php echo $_SESSION['login']; ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL . "logout.php"; ?>"> <i class="fa-solid fa-right-from-bracket"></i> Выход</a>
                    </li>

                </ul>
            </nav>

            <button class="burger" type="button">
                <span class="burger__item"></span>
            </button>
        </div>
    </div>
</header>