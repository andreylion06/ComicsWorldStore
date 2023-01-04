<?php

/** @var array $products */

use models\User;
?>


<h1 class="h3 mb-3 fw-normal text-center">Список товарів</h1>
<?php if(User::isAdmin()) : ?>
    <div class="mb-3">
        <a href="/product/add" class="btn btn-success">Додати товар</a>
    </div>
<?php endif; ?>

<div class="row row-cols-1 row-cols-md-4 g-4 categories-list">
    <?php foreach ($products as $row) : ?>
        <div class="col">
            <a href="/product/view/<?=$row['id'] ?>" class="card-link">
                <div class="card">
                    <?php $filePath = 'files/product/'.$row['photo'];?>
                    <?php if (is_file($filePath)) : ?>
                        <img src="/<?=$filePath?>" class="card-img-top" alt="...">
                    <?php else : ?>
                        <img src="/static/images/no-image.jpg" class="card-img-top" alt="...">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?=$row['name']?></h5>
                    </div>
                    <div class="card-body">
                        <?php if(User::isAdmin()) : ?>
                            <a href="/product/edit/<?=$row['id'] ?>" class="btn btn-primary">Edit</a>
                            <a href="/product/delete/<?=$row['id'] ?>" class="btn btn-danger">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
