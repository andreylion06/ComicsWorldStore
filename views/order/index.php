<?php

/** @var array $user */
/** @var array $errors */

//var_dump($errors);
//die;
?>

<h1 class="h3 mb-4 fw-normal text-center form-margin">Making order</h1>

<div class="w-50 m-auto mt-3">
    <form  action="" method="post">
        <div class="container">
            <div class="row">
                <div class="col mb-1">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?=$user['firstname']?> <?=$user['lastname']?>" aria-describedby="nameHelp">
                    <?php if (!empty($errors['name'])): ?>
                        <div id="nameHelp" class="form-text text-danger"><?=$errors['name']?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col mb-1">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="phone" class="form-control" name="phone" id="login" value="" aria-describedby="phoneHelp">
                    <?php if (!empty($errors['phone'])): ?>
                        <div id="phoneHelp" class="form-text text-danger"><?=$errors['phone']?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col mb-1">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" name="city" id="city" aria-describedby="cityHelp">
                    <?php if (!empty($errors['city'])): ?>
                        <span id="cityHelp" class="form-text text-danger"><?=$errors['city']?></span>
                    <?php endif; ?>
                </div>
                <div class="col mb-1">
                    <label for="post_number" class="form-label">Post office number</label>
                    <input type="text" class="form-control" name="post_number" id="post_number" value="" aria-describedby="post_numberHelp">
                    <?php if (!empty($errors['post_number'])): ?>
                        <span id="post_numberHelp" class="form-text text-danger"><?=$errors['post_number'] ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col mt-3 mb-3 text-center">
                    <button class="btn btn-primary w-100">Order</button>
                </div>
            </div>
        </div>
    </form>
</div>