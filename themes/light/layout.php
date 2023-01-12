<?php
/** @var string $title */
/** @var string $content */
/** @var string $siteName */

use models\User;
use models\DataTable;
if (User::isUserAuthenticated())
    $user = User::getCurrentAuthenticatedUser();
else
    $user = null;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$siteName ?> | <?=$title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/themes/light/css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="top-row">
                <div class="logo">
                    <a href="/">
                        <img src="../../static/layout/logo.png" width="200"/>
                    </a>
                </div>
                <div class="search">
                    <form action="" method="post">
                        <div class="search-module input-group rounded">
                            <input type="text" name="search" class="form-control rounded" value="<?=$_GET['search']?>" placeholder="Search" />
                            <button type="submit" name="btn-search" class="input-group-text border-0" id="search">
                              <img src="../../static/layout/search.png" width="20">
                            </button>
                        </div>
                    </form>
                </div>
                <?php
                    if(isset($_POST['btn-search'])) {
                        header("Location: /product/index?search={$_POST['search']}");
                    }
                ?>
                <div class="user">
                    <?php if (User::isUserAuthenticated()) : ?>
                        <a href="/user" class="btn btn-light text-dark  me-2 <?php if (User::isAdmin()) echo 'admin-label'?>">Hello, <?=$user['firstname']?></a>
                        <a href="/basket" class="btn btn-light text-dark me-2">
                            Basket
                            <span class="count-in-basket">
                                <?php
                                    $count = \models\Basket::getCountItems();
                                    if($count > 0) echo "({$count})";
                                ?>
                            </span>
                        </a>
                        <a href="/user/logout" class="btn btn-light text-dark me-2">Вийти</a>
                    <?php else : ?>
                        <a href="/user/login" class="btn btn-light text-dark me-2 ">Login</a>
                        <a href="/user/register" class="btn btn-dark">Register</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="bottom-row">
                <ul class="modules">
                    <li><a href="/">Home</a></li>
                    <li><a href="/product">All Products</a></li>
                    <li><a href="/category">Categories</a></li>
                    <li><a href="/brand">Brands</a></li>
                    <li><a href="/theme">Theme</a></li>
                    <li><a href="/personage">Personages</a></li>
                </ul>
            </div>
        </header>

        <main>
            <div class="container">
                <?=$content ?>
            </div>
        </main>

        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="/" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="/products" class="nav-link px-2 text-muted">All Products</a></li>
                <li class="nav-item"><a href="https://www.instagram.com/" class="nav-link px-2 text-muted">Instagram</a></li>
                <li class="nav-item"><a href="https://www.facebook.com/" class="nav-link px-2 text-muted">Facebook</a></li>
                <li class="nav-item"><a href="https://twitter.com/home" class="nav-link px-2 text-muted">Twitter</a></li>

            </ul>
            <p class="text-center text-muted">© 2022 Andrii Sakhno</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</body>
</html>