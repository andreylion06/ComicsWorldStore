<?php
/** @var array $category */
?>

<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Delete category "<?=$category['name']?>"?</h4>
    <p>After removing a category, all products in this category will fall into the standard category <b>"Undefined"</b></p>
    <hr>
    <p class="mb-0">
        <a href="/category/delete/<?=$category['id']?>/yes" class="btn btn-danger">Delete</a>
        <a href="/category" class="btn btn-dark">Cancel</a>
    </p>
</div>
