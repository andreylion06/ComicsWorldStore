<?php
/** @var string|null $error */
/** @var array $model */
\core\Core::getInstance()->pageParams['title'] = 'Login';
?>

<h1 class="h3 mb-4 fw-normal text-center form-margin">Log in to your account</h1>

<div class="form-login w-100 m-auto">
    <form action="" method="post">
        <?php if(!empty($error)) : ?>
            <div class="message error text-center mb-2">
                <?=$error?>
            </div>
        <?php endif; ?>
        <div class="form-floating mb-2">
            <input type="email" class="form-control" name="login" id="login" value="<?=$model['login']?>" placeholder="name@example.com">
            <label for="login">Email</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control" name="password" id="password" value="<?=$model['password']?>" placeholder="Password">
            <label for="password">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
    </form>
</div>