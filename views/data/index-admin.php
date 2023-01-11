<?php
/** @var string $moduleName */
/** @var array $rows */

use models\User;

$lTableName = ucfirst($moduleName);
?>
<h1 class="h3 mb-4 fw-normal text-center"><?=$lTableName?> list</h1>
<?php if(User::isAdmin()) : ?>
<div class="mb-3">
    <a href="/<?=$moduleName?>/add" class="btn btn-success">Add a <?=$moduleName?></a>
</div>
<?php endif; ?>
<div class="row row-cols-1 row-cols-md-4 g-4 data-list">
    <?php foreach ($rows as $row) : ?>
        <div class="col">
            <a href="/<?=$moduleName?>/view/<?=$row['id'] ?>" class="card-link">
                <div class="card">
                    <?php $filePath = 'files/'.$moduleName.'/'.$row['photo'];?>
                    <?php if (is_file($filePath)) : ?>
                        <img src="/<?=$filePath?>" class="card-img-top" alt="...">
                    <?php else : ?>
                        <img src="/static/images/no-image.jpg" class="card-img-top" alt="...">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?=$row['name']?></h5>
                    </div>
                    <div class="card-body">
                        <a href="/<?=$moduleName?>/edit/<?=$row['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="/<?=$moduleName?>/delete/<?=$row['id'] ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>