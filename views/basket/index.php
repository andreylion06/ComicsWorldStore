<?php
/** @var array $basket */
?>
<h1>Кошик</h1>
<table class="table">
    <thead>
        <tr>
            <th>№</th>
            <th>Назва товару</th>
            <th>Вартість одиниці</th>
            <th>Кількість</th>
            <th>Загальна вартість</th>
        </tr>
    </thead>
    <?php
    $index = 0;
    foreach ($basket['products'] as $row) : ?>
    <tr>
        <td><?=$index ?></td>
        <td><?=$row['product']['name'] ?></td>
        <td><?=$row['product']['price'] ?> грн.</td>
        <td><?=$row['product']['count'] ?></td>
        <td><?=$row['product']['price'] * $row['product']['count'] ?> грн.</td>
    </tr>
    <?php
    $index++;
    endforeach; ?>
    <tfoot>
        <tr>
            <th>Загальна сума</th>
            <th></th>
            <th></th>
            <th></th>
            <th><?=$basket['total_price'] ?> грн.</th>
        </tr>
    </tfoot>
</table>
