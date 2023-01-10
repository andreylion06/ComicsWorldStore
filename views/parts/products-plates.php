<?php
/** @var array $products */

use models\Basket;
use models\User;
?>

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
                    <?php
                    $classBtn = "";
                    $disableLink = "";
                    if ($row['count'] == Basket::getCountOfId($row['id'])) {
                        $classBtn = "disabled";
                        $disableLink = "href-dis";
                    }
                    ?>
                    <a href="/basket/add/<?=$row['id']?>" class="<?=$disableLink?>">
                        <div class="btn cart-btn <?=$classBtn?>">
                            <img src="../../static/layout/cart.svg">
                        </div>
                    </a>
                </div>
                <div class="card-body">
                    <?php if(User::isAdmin()) : ?>
                        <div class="card-row <?php if($row['count'] == 0) echo 'text-danger fw-bold' ?>">
                            <?=$row['count']?> in stock
                        </div>
                        <a href="/product/edit/<?=$row['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="/product/delete/<?=$row['id'] ?>" class="btn btn-danger">Delete</a>
                    <?php endif; ?>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>