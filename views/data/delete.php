<?php
/** @var array $tableName */
/** @var array $row */
?>

<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Delete <?=$tableName?> "<?=$row['name']?>"?</h4>
    <p>After removing a <?=$tableName?>, all products in this <?=$tableName?> will fall into the standard <?=$tableName?> <b>"Undefined"</b></p>
    <hr>
    <p class="mb-0">
        <a href="/category/delete/<?=$row['id']?>/yes" class="btn btn-danger">Delete</a>
        <a href="../../index.php" class="btn btn-dark">Cancel</a>
    </p>
</div>
