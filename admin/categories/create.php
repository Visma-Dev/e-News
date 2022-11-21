<?php include("../../path.php");

    include '../../app/db/connect.php';
    include '../../app/controllers/categories.php';
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
        <!-- Создание Категории -->
        <div class="posts col-8">
            <h1>Создание Категории:</h1>
            <div class="buttons row col-5">
                <a href="index.php" class="col-4 btn btn-manage">Управление</a>
            </div>
            <div class="row add">
                <form action="create.php" method="post">
                    <div class="col">
                        <input name="name" value="<?= $name;?>" type="text" class="form-control" placeholder="Название" aria-label="Название Категории">
                        <div class="col">
                            <label for="content" class="form-label">Описание категории</label>
                            <textarea name="description" class="form-control" id="content" rows="6" placeholder="Текст"><?=$description?></textarea>
                        </div>
                        <!-- errMessage -->
                        <div class="form-group col-12 col-md-4 error">
                            <p><?php echo $errMessage?></p>
                        </div>
                        <div class="col">
                            <button name="create" class="btn btn-primary" type="submit">Публикация</button>
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
