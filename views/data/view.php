<?php
/** @var string $moduleName */
/** @var array $row */
/** @var array $products */

use models\User;

\core\Core::getInstance()->pageParams['title'] = "View {$moduleName}";
?>
<h1 class="h3 mb-4 fw-normal text-center"><?=$row['name']?></h1>
<?php if(User::isAdmin()) : ?>
    <div class="mb-3">
        <a href="/product/add/<?=$moduleName?>/<?=$row['id']?>" class="btn btn-success">Add product</a>
    </div>
<?php endif; ?>

<?php require 'views/parts/products-plates.php'?>