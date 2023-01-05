<?php
/** @var array $rows */
use models\User;
?>
<h2>List of categories</h2>
<?php if(User::isAdmin()) : ?>
<div class="mb-3">
    <a href="/category/add" class="btn btn-success">Add a category</a>
</div>
<?php endif; ?>
<div class="row row-cols-1 row-cols-md-4 g-4 categories-list">
    <?php foreach ($rows as $row) : ?>
        <div class="col">
            <a href="/category/view/<?=$row['id'] ?>" class="card-link">
                <div class="card">
                    <?php $filePath = 'files/category/'.$row['photo'];?>
                    <?php if (is_file($filePath)) : ?>
                        <img src="/<?=$filePath?>" class="card-img-top" alt="...">
                    <?php else : ?>
                        <img src="/static/images/no-image.jpg" class="card-img-top" alt="...">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?=$row['name']?></h5>
                    </div>
                    <div class="card-body">
                        <a href="/category/edit/<?=$row['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="/category/delete/<?=$row['id'] ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>