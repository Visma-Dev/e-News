<?php include("path.php");?>
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
    <link rel="stylesheet" href="assets/css/log.css">
</head>

<body>
<!-- Header -->
<?php include("app/include/header.php");?>

<!-- Form -->
<div class="container reg-form">
    <form class="row justify-content-center" method="post" action="log.html">
        <h2>Вход</h2>
        <div class="form-group col-12 col-md-4">
            <label for="exampleInputLogin"><i class="fa-solid fa-hashtag"></i> Ваше имя на сайте (только латиница)</label>
            <input type="login" class="form-control" id="exampleInputLogin" aria-describedby="emailHelp" placeholder="Введите логин">
        </div>
        <div class="w-100"></div>
        <div class="form-group col-12 col-md-4">
            <label for="exampleInputPassword1"><i class="fa-solid fa-lock"></i> Пароль</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль">
        </div>
        <div class="w-100"></div>
        <div class="form-group col-12 col-md-4">
            <button type="submit" class="btn">Войти</button>
            <a href="reg.php">Регистрация</a>
        </div>
    </form>
</div>

<!-- Footer -->
<?php include("app/include/footer.php");?>