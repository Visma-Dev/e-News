<?php include("../../path.php");
include '../../app/db/connect.php';
include '../../app/controllers/posts.php';


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
        <!-- Создание Статьи -->
        <div class="posts col-8">
            <h1>Создание Статьи:</h1>
            <div class="buttons row col-5 mb-4">
                <a href="index.php" class="col-4 btn btn-manage">Управление</a>
            </div>
            <div class="row add-post">
                <form action="create.php" method="post">
                    <div class="col">
                        <div class="col mb-4">
                        <input name="title" type="text" class="form-control" placeholder="Название" aria-label="Название Статьи">
                        </div>
                        <div class="col mb-3">
                            <label  for="editor" class="form-label">Содержимое статьи</label>
                            <textarea name="content" id="editor" class="form-control" rows="6"></textarea>
                        </div>
                        <div class="input-group col mb-4">
                            <input name="img" type="file" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Медиафайлы</label>
                        </div>
                        <label for="content" class="form-label">Категория</label>
                        <select name="category" class="form-select mb-4" aria-label="Default select example">
                            <?php foreach ($categories as $key => $category): ?>
                            <option value="<?=$key + 1 ?>"><?=$category['name']?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="col">
                            <button name="add_post" class="btn btn-primary" type="submit">Публикация</button>
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

<!-- Подключение ckeditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>
<script src="/assets/js/ckeditor.js "></script>

</body>
</html>
