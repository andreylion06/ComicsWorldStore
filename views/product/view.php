<?php
/** @var array $product */
?>
<h1 class="h3 mb-3 fw-normal text-center"><?= $product['name'] ?></h1>
<div class="container">
    <div class="row">
        <div class="col-6">
            <?php $filePath = 'files/product/' . $product['photo']; ?>
            <?php if (is_file($filePath)) : ?>
                <img src="/<?= $filePath ?>" class="img-thumbnail" alt="...">
            <?php else : ?>
                <img src="/static/images/no-image.jpg" class="img-thumbnail" alt="...">
            <?php endif; ?>
        </div>
        <div class="col-6">
            <div class="row mb-3">
                <div class="col-4">
                    Ціна товару:
                </div>
                <div class="col-8">
                    <strong><?= $product['price'] ?> грн.</strong>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    Доступна кількість:
                </div>
                <div class="col-8">
                    <strong><?= $product['count'] ?> шт.</strong>
                </div>
            </div>
            <?php if(!empty($product['short_description'])) :?>
            <div class="row mb-3">
                <div class="col-4">
                    Короткий опис:
                </div>
                <div class="col-8">
                    <?= $product['short_description'] ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="row mb-3">
                <div class="col-4">
                    Кількість:
                </div>
                <div class="col-3">
                    <input min="1" max="<?=$product['count']?>" value="1" class="form-control" type="number" name="count" id="count"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4"></div>
                <div class="col-3">
                    <button class="btn btn-primary">Придбати</button>
                </div>
            </div>
        </div>
    </div>
</div>
