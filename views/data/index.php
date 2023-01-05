<?php
/** @var array $moduleName */
/** @var array $rows */

$lTableName = ucfirst($moduleName);
?>

<h2><?=$lTableName?> list</h2>
<div class="row row-cols-1 row-cols-md-4 g-4 data-list">
    <?php foreach ($rows as $row) : ?>
        <div class="col">
            <a href="/{$tableName}/view/<?=$row['id'] ?>" class="card-link">
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

                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
