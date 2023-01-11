<?php
/** @var array $errors */
/** @var array $model */

\core\Core::getInstance()->pageParams['title'] = 'Реєстрація на сайті';
?>

<h1 class="h3 mb-4 fw-normal text-center form-margin">New User Registration</h1>

<div class="w-50 m-auto mt-3">
    <form  action="" method="post">
        <div class="container">
            <div class="row">
                <div class="col mb-1">
                    <label for="login" class="form-label">Login (Email)</label>
                    <input type="email" class="form-control" name="login" id="login" value="<?=$model['login']?>" aria-describedby="emailHelp">
                    <?php if (!empty($errors['login'])): ?>
                        <div id="emailHelp" class="form-text text-danger"><?=$errors['login'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col mb-1">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" value="<?=$model['password']?>" aria-describedby="passwordHelp">
                    <?php if (!empty($errors['password'])): ?>
                        <span id="passwordHelp" class="form-text text-danger"><?=$errors['password'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="col mb-1">
                    <label for="password2" class="form-label">Repeat password</label>
                    <input type="password" class="form-control" name="password2" id="password2" value="<?=$model['password2']?>" aria-describedby="password2Help">
                    <?php if (!empty($errors['password2'])): ?>
                        <span id="password2Help" class="form-text text-danger"><?=$errors['password2'] ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col mb-1">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" value="<?=$model['firstname']?>" aria-describedby="lastnameHelp">
                    <?php if (!empty($errors['firstname'])): ?>
                        <span id="lastnameHelp" class="form-text text-danger"><?=$errors['firstname'] ?></span>
                    <?php endif; ?>
                </div>
                <div class="col mb-1">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" value="<?=$model['lastname']?>" aria-describedby="lastnameHelp">
                    <?php if (!empty($errors['lastname'])): ?>
                        <span id="lastnameHelp" class="form-text text-danger"><?=$errors['lastname'] ?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col mt-3 mb-3 text-center">
                    <button class="btn btn-primary w-100">Register</button>
                </div>
            </div>
        </div>
    </form>
</div>