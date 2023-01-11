<?php

/** @var array $products */
/** @var array $pagination */
/** @var string $searchString */

use models\User;
?>

<h1 class="h3 mb-4 fw-normal text-center">Product list</h1>
<?php if(User::isAdmin()) : ?>
    <div class="mb-3">
        <a href="/product/add" class="btn btn-success">Add product</a>
    </div>
<?php endif; ?>

<?php require 'views/parts/products-plates.php'?>

<?php
$paginationBar = \utils\Pagination::GetStylingArray(
    $pagination['page'],
    $pagination['count'],
    $pagination['totalNumber']
);
$pagination = $paginationBar['paginationNums'];
?>
<nav class="nav-pagination">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link <?=$paginationBar['previous']?>" href="/product/index?search=<?=$searchString?>&page=<?=$paginationBar['previous']?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php foreach ($pagination as $key => $value) :?>
            <li class="page-item">
                <a
                    class="page-link <?=$value?>"
                    href="/product/index?search=<?=$searchString?>&page=<?=$key?>"
                >
                    <?=$key?>
                </a>
            </li>
        <?php endforeach; ?>
        <li class="page-item">
            <a class="page-link <?=$paginationBar['next']?>" href="/product/index?search=<?=$searchString?>&page=<?=$paginationBar['next']?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>