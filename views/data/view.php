<?php
/** @var string $moduleName */
/** @var array $row */
/** @var array $products */

use models\User;

?>
<h1><?=$row['name']?></h1>
<?php if(User::isAdmin()) : ?>
    <div class="mb-3">
        <a href="/product/add/<?=$moduleName?>/<?=$row['id']?>" class="btn btn-success">Add product</a>
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
