<nav aria-label="Page navigation example">
  <ul class="pagination">

    <!-- Если номер текущей страницы больше чем 1, то выводим кнопку перехода на предыдущую страницу-->
    <?php if ($_GET['page'] > 1):?>
        <li class="page-item">
            <a class="page-link" href="?page=<?=$_GET['page'] - 1 ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
    <?php endif;?>

      <!-- вывод текущей страницы -->
      <li class="page-item"><a class="page-link" href="?page=<?=$_GET['page']?>"><?=$pageNumber?></a></li>

      <!-- Если номер текущей страницы больше чем их общее кол-во, то выводим кнопку перехода на следующую, вместе с ее номером -->
      <?php if(($pageNumber) < $totalPage):?>
      <li class="page-item"><a class="page-link" href="?page=<?=$_GET['page'] + 1?>"><?=$pageNumber + 1?></a></li>
      <?php endif;?>

      <!-- Если номер следующей страницы больше чем их общее кол-во, то выводим кнопку перехода на после-следующую, вместе с ее номером -->
      <?php if(($pageNumber + 1) < $totalPage):?>
      <li class="page-item"><a class="page-link" href="?page=<?=$_GET['page'] + 2?>"><?=$pageNumber + 2?></a></li>
      <?php endif;?>

    <!-- Если номер текущей страницы больше чем их общее кол-во, то выводим кнопку перехода на следующую-->
    <?php if(($pageNumber) < $totalPage):?>
        <li class="page-item">
          <a class="page-link" href="?page=<?=$_GET['page'] + 1 ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
    <?php endif;?>
  </ul>
</nav>