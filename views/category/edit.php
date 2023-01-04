<?php
/** @var array $category */
/** @var array $model */
/** @var array $errors */
?>
<h2>Editing a category</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Category name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $category['name']?>">
        <?php if (!empty($errors['name'])): ?>
            <div class="form-text text-danger"><?=$errors['name'] ?></div>
        <?php endif; ?>
    </div>
    <div class="col-3">
        <?php $filePath = 'files/category/'.$category['photo'];?>
        <?php if (is_file($filePath)) : ?>
            <img src="/<?=$filePath?>" class="card-img-top img-thumbnail" alt="...">
        <?php else : ?>
            <img src="/static/images/no-image.jpg" class="card-img-top img-thumbnail" alt="...">
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Photo file for category (replace photo)</label>
        <input type="file" class="form-control" name="file" id="file" accept="image/jpeg"/>
    </div>
    <div>
        <button class="btn btn-primary">Save</button>
    </div>
</form>
