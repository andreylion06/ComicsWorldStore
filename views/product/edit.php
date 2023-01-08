<?php
/** @var array $row */
/** @var array $model */
/** @var array $errors */
/** @var array $categories */
/** @var array $themes */
/** @var array $personages */
/** @var array $brands */

if(isset($model)) $row = $model;
?>

<h2>Editing a product</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Product name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?=$row['name']?>">
        <?php if (!empty($errors['name'])): ?>
            <div class="form-text text-danger"><?=$errors['name'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Select a product category</label>
        <select class="form-control" id="category_id" name="category_id">
            <?php
            foreach ($categories as $category_row) :
                ?>
                <option <?php if($category_row['id'] == $row['category_id']) echo 'selected'; ?> value="<?=$category_row['id']?>"><?=$category_row['name']?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['category_id'])): ?>
            <div class="form-text text-danger"><?=$errors['category_id'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="theme_id" class="form-label">Select a product theme</label>
        <select class="form-control" id="theme_id" name="theme_id">
            <?php foreach ($themes as $theme_row) : ?>
                <option <?php if($theme_row['id'] == $row['theme_id']) echo 'selected'; ?> value="<?=$theme_row['id']?>"><?=$theme_row['name']?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['theme_id'])): ?>
            <div class="form-text text-danger"><?=$errors['theme_id'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="theme_id" class="form-label">Select a product personage</label>
        <select class="form-control" id="personage_id" name="personage_id">
            <?php foreach ($personages as $personage_row) : ?>
                <option <?php if($personage_row['id'] == $row['personage_id']) echo 'selected'; ?> value="<?=$personage_row['id']?>"><?=$personage_row['name']?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['personage_id'])): ?>
            <div class="form-text text-danger"><?=$errors['personage_id'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="theme_id" class="form-label">Select a product brand</label>
        <select class="form-control" id="brand_id" name="brand_id">
            <?php foreach ($brands as $brand_row) : ?>
                <option <?php if($brand_row['id'] == $row['brand_id']) echo 'selected'; ?> value="<?=$brand_row['id']?>"><?=$brand_row['name']?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['brand_id'])): ?>
            <div class="form-text text-danger"><?=$errors['brand_id'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">The price of the product</label>
        <input type="number" class="form-control" id="price" name="price" value="<?=$row['price']?>">
        <?php if (!empty($errors['price'])): ?>
            <div class="form-text text-danger"><?=$errors['price'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="count" class="form-label">Number of units of the product</label>
        <input type="number" class="form-control" id="count" name="count" value="<?=$row['count']?>">
        <?php if (!empty($errors['count'])): ?>
            <div class="form-text text-danger"><?=$errors['count'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="short_description" class="form-label">Brief description</label>
        <textarea class="ck-editor form-control" name="short_description" id="short_description"><?=$row['short_description']?></textarea>
        <?php if (!empty($errors['short_description'])): ?>
            <div class="form-text text-danger"><?=$errors['short_description'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Extended description</label>
        <textarea class="ck-editor form-control" name="description" id="description"><?=$row['description']?></textarea>
        <?php if (!empty($errors['description'])): ?>
            <div class="form-text text-danger"><?=$errors['description'] ?></div>
        <?php endif; ?>
    </div>
    <div class="col-3">
        <?php $filePath = 'files/product/'.$row['photo'];?>
        <?php if (is_file($filePath)) : ?>
            <img src="/<?=$filePath?>" class="card-img-top img-thumbnail">
        <?php else : ?>
            <img src="/static/images/no-image.jpg" class="card-img-top img-thumbnail">
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">A file with a photo for the product</label>
        <input type="file" class="form-control" name="file" id="file" accept="image/jpeg" value=""/>
        <?php if (!empty($errors['file'])): ?>
            <div class="form-text text-danger"><?=$errors['file'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="visible" class="form-label">Display the product?</label>
        <select class="form-control" id="visible" name="visible">
            <option value="1" <?php if($row['visible']) echo 'selected'; ?>>Yes</option>
            <option value="0" <?php if(!$row['visible']) echo 'selected'; ?>>No</option>
        </select>
    </div>
    <div>
        <button class="btn btn-primary">Edit</button>
    </div>
</form>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    let editors = document.querySelectorAll('.ck-editor');
    for(let editor of editors) {
        ClassicEditor
            .create(editor)
            .catch( error => {
                console.error(error);
            } );
    }
</script>