<?php

use models\Order;
use models\User;

/** @var array $orders */

\core\Core::getInstance()->pageParams['title'] = 'Your orders';
?>
<h1 class="h3 mb-4 fw-normal">Orders</h1>

<div class="wrapper-user">
    <div class="hor-menu">
        <a href="/user"><div class="menu-item selected">Orders</div></a>
        <?php if(User::isAdmin()): ?>
            <a href="/user/statistics"><div class="menu-item">Statistics</div></a>
        <?php endif; ?>
    </div>
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
                    <td><a href="tel: <?=$row['phone']?>"><?=$row['phone']?></a></td>
                    <td><?=$row['city']?></td>
                    <td><?=$row['post_number']?></td>
                    <td>
                        <?php
                            $items = Order::getOrderItems($row['id']);
                            $output = "";
                            for ($i = 0; $i <= count($items) - 1; $i++) {
                                $name = substr($items[$i]['product']['name'], 0, 30).'...';
                                $id = $items[$i]['product']['id'];
                                $output .= "<a href='/product/view/{$id}' class='styled'>{$items[$i]['count_in_order']} x {$name}</a><br>";
                            }
                            echo $output;
                        ?>
                    </td>
                    <td>
                        <form action="" method="post" class="form-status">
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
</div>

<style>
    .wrapper-user {
        display: flex;
        gap: 40px;
    }

    .hor-menu {
        margin-top: 40px;
        gap: 5px;
    }

    .hor-menu .menu-item {
        width: 200px;
        font-size: 20px;
        text-align: center;
        padding: 25px;

        cursor: pointer;
        border: 2px solid #f3f3f7;
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        transition: all 400ms;
    }

    .hor-menu .menu-item:hover,
    .hor-menu .menu-item.selected {
        background-color: #66E5B3;
    }


    .hor-menu .menu-item + .menu-item {
        margin-top: 5px;
    }

    .cart-btn {
        display: inline-block;
        padding: 5px 20px;

    }

    .cart-btn:hover {

        transform: scale(1.03);
    }
</style>