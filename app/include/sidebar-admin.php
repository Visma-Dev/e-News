<?php include "../../path.php";?>
<div class="sidebar col-2">
    <ul>
        <li>
                <a href="<?= BASE_URL . 'admin/posts/index.php'?>">Статьи</a> <!-- ?= сокращение ?php echo-->
        </li>
        <li>
            <a href="<?= BASE_URL . 'admin/categories/index.php'?>">Категории</a>
        </li>
        <li>
            <a href="<?= BASE_URL . 'admin/users/index.php'?>">Пользователи</a>
        </li>
    </ul>
</div>