<?php
/** @var string $moduleName */
/** @var array $rows */

use models\User;

$lModuleName = ucfirst($moduleName);

\core\Core::getInstance()->pageParams['title'] = "{$lModuleName}";
?>
<h1 class="h3 mb-4 fw-normal text-center"><?=$lModuleName?> list</h1>
<?php if(User::isAdmin()) : ?>
    <div class="mb-3">
        <a href="/<?=$moduleName?>/add" class="btn btn-success">Add a <?=$moduleName?></a>
    </div>
<?php endif; ?>
<div class="item-cards">
    <?php foreach ($rows as $row) : ?>
            <div class="item-card">
                <a href="/<?=$moduleName?>/view/<?=$row['id'] ?>" class="card-link">
                    <?php $filePath = 'files/'.$moduleName.'/'.$row['photo'];?>
                    <?php
                    if (is_file($filePath)) :?>
                        <img src="/<?=$filePath?>" class="avatar">
                    <?php else : ?>
                        <img src="/static/images/no-image.jpg" class="avatar">
                    <?php endif; ?>
                    <div class="name bigger">
                        <?=$row['name']?>
                    </div>
                    <div class="count-of-items">
                        <i><?=$row['products_count']?> items</i>
                    </div>
                    <div class="card-body">
                        <?php if(User::isAdmin() && $row['name'] != 'Default') : ?>
                            <a href="/<?=$moduleName?>/edit/<?=$row['id'] ?>" class="btn btn-primary">Edit</a>
                            <a href="/<?=$moduleName?>/delete/<?=$row['id'] ?>" class="btn btn-danger">Delete</a>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
    <?php endforeach; ?>
</div>