<?php

/** @var array $products */
/** @var array $pagination */

use models\User;
?>


<h1 class="h3 mb-3 fw-normal text-center">Product list</h1>
<?php if(User::isAdmin()) : ?>
    <div class="mb-3">
        <a href="/product/add" class="btn btn-success">Add product</a>
    </div>
<?php endif; ?>
<div class="item-cards">
    <?php foreach ($products as $row) : ?>
        <?php if (!$row['visible'] && !User::isAdmin()) continue; ?>
        <div class="item-card">
            <a href="/product/view/<?=$row['id'] ?>" class="card-link">
                <?php $filePath = 'files/product/'.$row['photo'];?>
                <?php if (is_file($filePath)) : ?>
                        <img src="/<?=$filePath?>" class="avatar product-avatar <?php if(!$row['visible']) echo 'black-white'?>">
                <?php else : ?>
                    <img src="/static/images/no-image.jpg" class="avatar <?php if(!$row['visible']) echo 'black-white'?>">
                <?php endif; ?>
                <?php if (!$row['visible']) : ?>
                    <img src="../../static/layout/unvisible.png" class="invis">
                <?php endif; ?>
                <div class="product-name name">
                    <?=$row['name']?>
                </div>
                <div class="card-row">
                    <div class="price">
                        <span class="number"><?=$row['price']?></span> <span class="cur">hrn.</span>
                    </div>
                    <div class="cart-btn">
                        <img src="../../static/layout/cart.svg">
                    </div>
                </div>
                <div class="card-body">
                    <?php if(User::isAdmin()) : ?>
                        <a href="/product/edit/<?=$row['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="/product/delete/<?=$row['id'] ?>" class="btn btn-danger">Delete</a>
                    <?php endif; ?>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
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
            <a class="page-link <?=$paginationBar['previous']?>" href="/product/index/<?=$paginationBar['previous']?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php foreach ($pagination as $key => $value) :?>
            <li class="page-item">
                <a
                    class="page-link <?=$value?>"
                    href="/product/index/<?=$key?>"
                >
                    <?=$key?>
                </a>
            </li>
        <?php endforeach; ?>
        <li class="page-item">
            <a class="page-link <?=$paginationBar['next']?>" href="/product/index/<?=$paginationBar['next']?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>