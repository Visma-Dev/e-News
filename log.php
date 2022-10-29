<?php
include("path.php");
include("app/controllers/users.php");
?>
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
    <form class="row justify-content-center" method="post" action="log.php">
        <h2>Вход</h2>
        <div class="form-group col-12 col-md-4">
            <label for="exampleInputEmail1"><i class="fa-solid fa-hashtag"></i> Email, указанный при регистрации</label>
            <input name="email" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите свой почтовый ящик">
        </div>
        <div class="w-100"></div>
        <div class="form-group col-12 col-md-4">
            <label for="exampleInputPassword1"><i class="fa-solid fa-lock"></i> Пароль</label>
            <input name="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль">
        </div>
        <div class="w-100"></div>
        <!-- errMessage -->
        <div class="form-group col-12 col-md-4 error">
            <p><?php echo $errMessage?></p>
        </div>
        <div class="w-100"></div>
        <div class="form-group col-12 col-md-4">
            <button type="submit" class="btn" name = "btn_log">Войти</button>
            <a href="reg.php">Регистрация</a>
        </div>
    </form>
</div>

<!-- Footer -->
<?php include("app/include/footer.php");?>