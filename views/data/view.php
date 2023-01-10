<?php
/** @var string $moduleName */
/** @var array $row */
/** @var array $products */

use models\User;

?>
<h1><?=$row['name']?></h1>
<?php if(User::isAdmin()) : ?>
    <div class="mb-3">
        <a href="/product/add/<?=$moduleName?>/<?=$row['id']?>" class="btn btn-success">Add product</a>
    </div>
<?php endif; ?>

<?php require 'views/parts/products-plates.php'?>