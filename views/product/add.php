<?php
/** @var array $model */
/** @var array $errors */
/** @var array $categories */
/** @var int|null $category_id */
?>

<h2>Додавання товару</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="name" class="form-label">Назва товару</label>
        <input type="text" class="form-control" id="name" name="name">
        <?php if (!empty($errors['name'])): ?>
            <div class="form-text text-danger"><?=$errors['name'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Виберіть категорію товару</label>
        <select class="form-control" id="category_id" name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option <?php if($category['id'] == $category_id) echo 'selected'; ?> value="<?=$category['id']?>"><?=$category['name']?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['category_id'])): ?>
            <div class="form-text text-danger"><?=$errors['category_id'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Ціна товару</label>
        <input type="number" class="form-control" id="price" name="price">
        <?php if (!empty($errors['price'])): ?>
            <div class="form-text text-danger"><?=$errors['price'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="count" class="form-label">Кількість одиниць товару</label>
        <input type="number" class="form-control" id="count" name="count">
        <?php if (!empty($errors['count'])): ?>
            <div class="form-text text-danger"><?=$errors['count'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="short_description" class="form-label">Короткий опис</label>
        <textarea class="ck-editor form-control" name="short_description" id="short_description"></textarea>
        <?php if (!empty($errors['short_description'])): ?>
            <div class="form-text text-danger"><?=$errors['short_description'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Розширений опис</label>
        <textarea class="ck-editor form-control" name="description" id="description"></textarea>
        <?php if (!empty($errors['description'])): ?>
            <div class="form-text text-danger"><?=$errors['description'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Файл з фотографією для товару</label>
        <input type="file" class="form-control" name="file" id="file" accept="image/jpeg"/>
        <?php if (!empty($errors['file'])): ?>
            <div class="form-text text-danger"><?=$errors['file'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-3">
        <label for="visible" class="form-label">Чи відображати товар?</label>
        <select class="form-control" id="visible" name="visible">
            <option value="1">Так</option>
            <option value="0">Ні</option>
        </select>
    </div>
    <div>
        <button class="btn btn-primary">Додати</button>
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