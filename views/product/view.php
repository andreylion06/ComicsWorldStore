<?php
/** @var array $product */

use models\User;

?>
<div class="container view-container">
    <div class="row">
        <div class="col-3 col-img">
            <?php $filePath = 'files/product/' . $product['photo']; ?>
            <?php if (is_file($filePath)) : ?>
                <img src="/<?= $filePath ?>" class="product-view-avatar">
            <?php else : ?>
                <img src="/static/images/no-image.jpg" class="product-view-avatar">
            <?php endif; ?>
        </div>
        <div class="col-9 col-info">
            <div class="row mb-1">
                <h3 class="h4"><?= $product['name'] ?></h3>
            </div>
            <div class="buy-block">
                <div>
                    <span class="price"><?=$product['price']?></span> <span class="cur">hrn.</span>
                </div>
                <?php
                $countInBasket = \models\Basket::getCountOfId($product['id']);
                $classBtn = "";
                $disableLink = "";

                if(User::isUserAuthenticated() && $countInBasket != 0) {
                    if ($countInBasket < $product['count'])
                        $outputBtn = "Add ({$countInBasket} in basket)";
                    else if ($countInBasket == $product['count']) {
                        $outputBtn = "All is in the basket ({$countInBasket})";
                        $classBtn = "disabled";
                    }
                }
                else if($product["count"] == 0) {
                    $outputBtn = "Out of stock";
                    $classBtn = "disabled";
                    $disableLink = "href-dis";
                }
                else {
                    $outputBtn = "Add to basket";
                }

                ?>
                <a href="/basket/add/<?=$product['id']?>" class="<?=$disableLink?>">
                    <div class="btn cart-btn <?=$classBtn?>">
                        <?=$outputBtn?>
                    </div>
                </a>
            </div>
            <div class="row mb-1">
                <section>
                    <div class="row-info">
                        <span class="fw-bold">Доставка</span>
                    </div>
                    <div class="row-delivery row-info">
                        <a href="https://novaposhta.ua/">
                            <img src="../../static/layout/nova_poshta.svg" class="icon"/>
                            <span class="name">Nova Poshta</span>
                            <span class="description">you can pick it up within <b>1-3 days</b> at the branch</span>
                        </a>
                    </div>
                    <div class="row-delivery row-info">
                        <a href="https://www.ukrposhta.ua/ua">
                            <img src="../../static/layout/ukr_pochta.png" class="icon"/>
                            <span class="name">Ukr Poshta</span>
                            <span class="description">you can pick it up within <b>3-7 days</b> at the branch</span>
                        </a>
                    </div>
                    <div class="row-delivery row-info">
                        <a href="https://novaposhta.ua/dostavka_courier">
                            <img src="../../static/layout/car.svg" class="icon"/>
                            <span class="name">By courier</span>
                            <span class="description">carried out by <b>Nova Poshta</b></span>
                        </a>
                    </div>
                </section>
                <section>
                    <div class="row-info">
                        <span class="fw-bold">Payment</span>
                    </div>
                    <div class="row-delivery row-info">
                        <a>
                            <img src="../../static/layout/card.svg" class="icon"/>
                            <span class="name">Card</span>
                        </a>
                        <a>
                            <img src="../../static/layout/cash.svg" class="icon"/>
                            <span class="name">Cash</span>
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="row descriptions">
        <div class="col-12">
            <div class="brief-description">
                <span class="title">Brief description:</span>
                <span class="description"><?=$product['short_description']?></span>
                <span class="title">Full description:</span>
                <span class="description"><?=$product['description']?></span>
            </div>
        </div>
    </div>
</div>
