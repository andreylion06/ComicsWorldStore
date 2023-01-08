<?php
/** @var array $moduleName */
/** @var array $row */
?>

<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Delete <?=$moduleName?> "<?=$row['name']?>"?</h4>
    <p>After removing a <?=$moduleName?>, all products in this <?=$moduleName?> will fall into the standard <?=$moduleName?> <b>"Default"</b></p>
    <hr>
    <p class="mb-0">
        <a href="/<?=$moduleName?>/delete/<?=$row['id']?>/yes" class="btn btn-danger">Delete</a>
        <a href="../../index.php" class="btn btn-dark">Cancel</a>
    </p>
</div>
