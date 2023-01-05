<?php
/** @var string $tableName */
/** @var array $model */
/** @var array $errors */

$lTableName = ucfirst($tableName);
?>

<h2>Add <?=$tableName?></h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label"><?=$lTableName?> name</label>
        <input type="text" class="form-control" id="name" name="name">
        <?php if (!empty($errors['name'])): ?>
            <div class="form-text text-danger"><?=$errors['name'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">File with photo for <?=$tableName?></label>
        <input type="file" class="form-control" name="file" id="file" accept="image/jpeg"/>
    </div>
    <div>
        <button class="btn btn-primary">Add</button>
    </div>
</form>