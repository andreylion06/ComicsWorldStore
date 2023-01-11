<?php
/** @var string $moduleName */
/** @var array $model */
/** @var array $errors */

$lTableName = ucfirst($moduleName);
?>

<h1 class="h3 mb-4 fw-normal text-center">Add <?=$moduleName?></h1>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label"><?=$lTableName?> name</label>
        <input type="text" class="form-control" id="name" name="name">
        <?php if (!empty($errors['name'])): ?>
            <div class="form-text text-danger"><?=$errors['name'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">File with photo for <?=$moduleName?></label>
        <input type="file" class="form-control" name="file" id="file" accept="image/jpeg"/>
    </div>
    <div>
        <button class="btn btn-primary">Add</button>
    </div>
</form>