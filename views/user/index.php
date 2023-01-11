<?php

use models\Order;
use models\User;

/** @var array $orders */
?>

<h1 class="h3 mb-4 fw-normal">Orders</h1>
<?php if(count($orders) == 0) : ?>
    <?php
    $text = [];
    if(User::isAdmin())
        $text += ['title' => 'No unconfirmed orders :)'];
    else {
        $text += ['title' => 'No unconfirmed orders'];
        $text += ['description' => 'But you can order some goods <a href="/product">here</a>.'];
    }
    ?>
    <div class="empty-block">
        <h3 class="h3"><?=$text['title']?></h3>
        <span><?=$text['description']?></span>
    </div>
<?php else : ?>

    <table class="table">
        <thead>
        <tr>
            <th>№</th>
            <th>Date</th>
            <th>Name</th>
            <th>Phone</th>
            <th>City</th>
            <th>Post Number</th>
            <th>Items</th>
            <th>Status</th>
        </tr>
        </thead>
        <?php
        $index = 1;
        foreach ($orders as $row) : ?>
            <tr class="table-row-dyn">
                <td><?=$index?></td>
                <td><?=$row['date']?></td>
                <td><?=$row['name']?></td>
                <td><?=$row['phone']?></td>
                <td><?=$row['city']?></td>
                <td><?=$row['post_number']?></td>
                <td>
                    <?php
                        $items = Order::getOrderItems($row['id']);
                        $output = "";
                    echo '<pre>';
//                    var_dump($items);
                        foreach ($items as $item) {
//                            $output += "{$item['product']['name']} * {$item['count']}";

                            var_dump($item);
                        }
//                        echo $output;
                    ?>
                </td>
                <td>
                    <form action="" method="post">
                        <a class="btn
                        <?php
                        if(!User::isAdmin())
                            echo " href-dis";

                        if($row['status'] == 'in processing')
                            echo ' btn-warning';
                        else if($row['status'] == 'approved')
                            echo ' btn-success';
                        ?>" href="/user/approve/<?=$row['id']?>"><?=ucfirst($row['status'])?></a>
                    </form>
                </td>
            </tr>
            <?php
            $index++;
        endforeach; ?>
        <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
<?php endif; ?>
