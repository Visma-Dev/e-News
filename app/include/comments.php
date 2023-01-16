<?php
require_once DIR_ROOT . '/app/controllers/comments.php';
?>

<script src="https://kit.fontawesome.com/2fc4dc419e.js" crossorigin="anonymous"></script>

<div class="comments_block col-md-12 col-12 ">
    <h3>Оставить комментарий</h3>
    <div class="write_comment">
        <!-- форма написания коммента -->
        <form action="<?=BASE_URL . "single.php?post=$postId";?>" method="post">
            <input type="hidden"  name="postNumber" value="<?=$postId?>">
            <input type="hidden"  name="userId" value="<?=$_SESSION['id']?>">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label"><i class="far fa-user"></i> <?=$_SESSION['login']?></label>
                <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <!-- errMessage -->
            <div class="form-group col-12 col-md-12 error">
                <p name="error"><?php echo $errMessage?></p>
            </div>
            <div class="col-12">
                <button type="submit" name="send" class="btn"><i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </form>

    </div>
    <!-- список комментариев -->
    <?php if($comments > 0):?>
        <div class="row comments_list">
            <?php foreach ($comments as $comment):?>
                <div class="def_comment col-12">
                    <!-- вывод функции удаления комментов, только для их авторов и админов -->
                    <?php if ($_SESSION['id'] == $comment['userId']): ?>
                        <a href="/single.php?post=<?=$postId?>&comm_id=<?=$comment['id'];?>"> <i class="fa-solid fa-trash"></i></a>
                    <?php elseif ($_SESSION['admin'] == 1): ?>
                        <a href="/single.php?post=<?=$postId?>&comm_id=<?=$comment['id'];?>"><i class="fa-solid fa-trash"></i></a>
                    <?php endif;?>

                    <?php $author = selectOne('users', ['id' => $comment['userId']]);?>
                    <span><i class="far fa-user"></i><?=' '. $author['username'];?></span>


                    <div class="col-12 content"><?=$comment['content']?></div>

                    <span class="date"><?=$comment['date']?></span>
                </div>
            <?php endforeach;?>
        </div>

    <?php endif;?>

</div>

