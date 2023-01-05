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
<div class="row row-cols-1 row-cols-md-4 g-4 data-list">
    <?php foreach ($products as $product) : ?>
        <div class="col">
            <a href="/product/view/<?=$product['id'] ?>" class="card-link">
                <div class="card">
                    <?php $filePath = 'files/product/'.$product['photo'];?>
                    <?php if (is_file($filePath)) : ?>
                        <img src="/<?=$filePath?>" class="card-img-top" alt="...">
                    <?php else : ?>
                        <img src="/static/images/no-image.jpg" class="card-img-top" alt="...">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?=$product['name']?></h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
