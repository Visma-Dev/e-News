<?php include("../../path.php");
include '../../app/db/connect.php';

session_start();
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
        <!-- Создание Пользователя -->
        <div class="posts col-8">
            <h1>Создание Пользователя:</h1>
            <div class="buttons row col-5">
                <a href="create.php" class="col-4 btn btn-create">Создать</a>
                <a href="index.php" class="col-4 btn btn-manage">Управление</a>
            </div>
            <div class="row add">
                <form action="create.php" method="post">
                    <div class="сol">
                        <label for="exampleInputLogin"><i class="fa-solid fa-hashtag"></i> Никнейм пользователя</label>
                        <input name="login" value="<?=$login?>" type="text" class="form-control" id="exampleInputLogin" aria-describedby="emailHelp" placeholder="Введите логин">
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <label for="exampleInputEmail1"><i class="fa-solid fa-envelope"></i> Email</label>
                        <input name="email" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите свой почтовый ящик">
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <label for="exampleInputPassword1"><i class="fa-solid fa-lock"></i> Пароль</label>
                        <input name="pass_f" type="password" class="form-control" id="exampleInputPassword1" placeholder="Придуймайте пароль">
                    </div>
                    <div class="w-100"></div>
                    <div class="col">
                        <label for="exampleInputPassword2"><i class="fa-solid fa-key"></i> Подтвердите пароль</label>
                        <input name="pass_s" type="password" class="form-control" id="exampleInputPassword2" placeholder="Повторно введите и запомните пароль">
                    </div>
                    <div class="w-100"></div>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Admin</option>
                        <option value="1">User</option>
                    </select>
                    <div class="col">
                        <div class="col">
                            <button class="btn btn-primary" type="submit">Зарегистр.</button>
                        </div>
                    </div>
                </form>
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
