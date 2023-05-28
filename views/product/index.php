<?php

/** @var array $products */
/** @var array $categories */
/** @var array $brands */
/** @var array $themes */
/** @var array $personages */
/** @var array $pagination */
/** @var array $requestParams */
/** @var int $page */

use models\User;

\core\Core::getInstance()->pageParams['title'] = 'Product list';
?>

<h1 class="h3 mb-4 fw-normal text-center">Product list</h1>
<?php if(User::isAdmin()) : ?>
    <div class="mb-3">
        <a href="/product/add" class="btn btn-success">Add product</a>
    </div>
<?php endif; ?>

<div class="filters">
    <form action="" method="get" enctype="multipart/form-data">
        <label for="category">Category</label>
        <select class="form-control" id="category" name="category" onchange="location = this.value;">
            <option class="form-control" value="/product/index?search=<?=$requestParams['search']?>&brand=<?=$requestParams['brand']?>&theme=<?=$requestParams['theme']?>&personage=<?=$requestParams['personage']?>&min=<?=$requestParams['min']?>&max=<?=$requestParams['max']?>">Select</option>
            <?php foreach ($categories as $row) :?>
                <option
                        class="form-control"
                        value="/product/index?search=<?=$requestParams['search']?>&category=<?=$row['id']?>&brand=<?=$requestParams['brand']?>&theme=<?=$requestParams['theme']?>&personage=<?=$requestParams['personage']?>&min=<?=$requestParams['min']?>&max=<?=$requestParams['max']?>"
                    <?php if($row['id'] == $requestParams['category']) echo 'selected'; ?>
                >
                    <?=$row['name']?>
                </option>
                </a>
            <?php endforeach; ?>
        </select>
        <label for="brand">Brand</label>
        <select class="form-control" id="brand" name="brand" onchange="location = this.value;">
            <option class="form-control" value="/product/index?search=<?=$requestParams['search']?>&category=<?=$requestParams['category']?>&theme=<?=$requestParams['theme']?>&personage=<?=$requestParams['personage']?>&min=<?=$requestParams['min']?>&max=<?=$requestParams['max']?>">Select</option>
            <?php foreach ($brands as $row) :?>
                    <option
                            class="form-control"
                            value="/product/index?search=<?=$requestParams['search']?>&category=<?=$requestParams['category']?>&brand=<?=$row['id']?>&theme=<?=$requestParams['theme']?>&personage=<?=$requestParams['personage']?>&min=<?=$requestParams['min']?>&max=<?=$requestParams['max']?>"
                            <?php if($row['id'] == $requestParams['brand']) echo 'selected'; ?>
                    >
                        <?=$row['name']?>
                    </option>
                </a>
            <?php endforeach; ?>
        </select>
        <label for="theme">Theme</label>
        <select class="form-control" id="theme" name="theme" onchange="location = this.value;">
            <option class="form-control" value="/product/index?search=<?=$requestParams['search']?>&category=<?=$requestParams['category']?>&brand=<?=$requestParams['brand']?>&personage=<?=$requestParams['personage']?>&min=<?=$requestParams['min']?>&max=<?=$requestParams['max']?>">Select</option>
            <?php foreach ($themes as $row) :?>
                <option
                        class="form-control"
                        value="/product/index?search=<?=$requestParams['search']?>&category=<?=$requestParams['category']?>&brand=<?=$requestParams['brand']?>&theme=<?=$row['id']?>&personage=<?=$requestParams['personage']?>&min=<?=$requestParams['min']?>&max=<?=$requestParams['max']?>"
                    <?php if($row['id'] == $requestParams['theme']) echo 'selected'; ?>
                >
                    <?=$row['name']?>
                </option>
                </a>
            <?php endforeach; ?>
        </select>
        <label for="personage">Personage</label>
        <select class="form-control" id="personage" name="personage" onchange="location = this.value;">
            <option class="form-control" value="/product/index?search=<?=$requestParams['search']?>&category=<?=$requestParams['category']?>&brand=<?=$requestParams['brand']?>&theme=<?=$requestParams['theme']?>&min=<?=$requestParams['min']?>&max=<?=$requestParams['max']?>">Select</option>
            <?php foreach ($personages as $row) :?>
                <option
                        class="form-control"
                        value="/product/index?search=<?=$requestParams['search']?>&category=<?=$requestParams['category']?>&brand=<?=$requestParams['brand']?>&theme=<?=$requestParams['theme']?>&personage=<?=$row['id']?>&min=<?=$requestParams['min']?>&max=<?=$requestParams['max']?>"
                    <?php if($row['id'] == $requestParams['personage']) echo 'selected'; ?>
                >
                    <?=$row['name']?>
                </option>
                </a>
            <?php endforeach; ?>
        </select>
    </form>

    <div class="price">
        <label for="min">Min. Price</label>
        <input
                type="number"
                class="form-control"
                placeholder="min"
                id="min"
                name="min"
                onkeypress="handleKeyPress(event)"
                value="<?=$requestParams['min']?>"
        >

        <label for="max">Max. Price</label>
        <input
                type="number"
                class="form-control"
                placeholder="max"
                id="max"
                name="max"
                onkeypress="handleKeyPress(event)"
                value="<?=$requestParams['max']?>"
        >
    </div>
</div>

<script>
    function handleKeyPress(event) {
        if (event.keyCode === 13) {
            let value = event.target.value;
            if(event.target.name == "min")
                window.location.href = "/product/index?search=<?=$requestParams['search']?>&category=<?=$requestParams['category']?>&brand=<?=$requestParams['brand']?>&theme=<?=$requestParams['theme']?>&personage=<?=$requestParams['personage']?>&min="+value+"&max=<?=$requestParams['max']?>";
            if(event.target.name == "max")
                window.location.href = "/product/index?search=<?=$requestParams['search']?>&category=<?=$requestParams['category']?>&brand=<?=$requestParams['brand']?>&theme=<?=$requestParams['theme']?>&personage=<?=$requestParams['personage']?>&min=<?=$requestParams['min']?>&max="+value;

        }
    }
</script>

<?php require 'views/parts/products-plates.php'?>

<?php if(empty($products)): ?>
    <h3 class="mt-5">Nothing found with these filters.</h3>
<?php endif; ?>

<?php
$paginationBar = \utils\Pagination::GetStylingArray(
    $pagination['page'],
    $pagination['count'],
    $pagination['totalNumber']
);
$pagination = $paginationBar['paginationNums'];
?>
<nav class="nav-pagination">
    <ul class="pagination">
        <li class="page-item">
            <a
                    class="page-link
                    <?=$paginationBar['previous']?>"
                    href="/product/index?search=<?=$requestParams['search']?>&page=<?=$paginationBar['previous']?>&category=<?=$requestParams['category']?>&brand=<?=$requestParams['brand']?>&theme=<?=$requestParams['theme']?>&personage=<?=$requestParams['personage']?>&min=<?=$requestParams['min']?>&max=<?=$requestParams['max']?>"
                    aria-label="Previous"
            >
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php foreach ($pagination as $key => $value) :?>
            <li class="page-item">
                <a
                    class="page-link <?=$value?>"
                    href="/product/index?search=<?=$requestParams['search']?>&page=<?=$key?>&category=<?=$requestParams['category']?>&brand=<?=$requestParams['brand']?>&theme=<?=$requestParams['theme']?>&personage=<?=$requestParams['personage']?>&min=<?=$requestParams['min']?>&max=<?=$requestParams['max']?>"
                >
                    <?=$key?>
                </a>
            </li>
        <?php endforeach; ?>
        <li class="page-item">
            <a class="page-link <?=$paginationBar['next']?>" href="/product/index?search=<?=$requestParams['search']?>&page=<?=$paginationBar['next']?>&category=<?=$requestParams['category']?>&brand=<?=$requestParams['brand']?>&theme=<?=$requestParams['theme']?>&min=<?=$requestParams['min']?>&max=<?=$requestParams['max']?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>

<style>
    .filters {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 10px;
        border: 2px solid #f3f3f7;
        border-radius: 20px;
        padding: 20px;
        margin: 20px 0;
    }

    .filters form {
        display: flex;
        gap: 10px;
    }

    .filters .price {
        display: flex;
        gap: 10px;
    }

    .filters input {
        width: 150px;
    }
</style>