<?php


namespace models;


use core\Core;
use utils\Filter;

class Order
{
    protected static $tableName = 'user_order';
    public static function addOrder($row) {
        $products = $row['products'];
        
        $fieldsList = ['date', 'user_id', 'name', 'phone', 'city', 'post_number'];
        $rowOrder = Filter::filterArray($row, $fieldsList);
        Core::getInstance()->db->insert(self::$tableName, $rowOrder);

        $orderId = self::getOrderId($rowOrder['user_id'], $rowOrder['date']);
        foreach ($products as $product) {
            Core::getInstance()->db->insert('order_item', [
                'order_id' => $orderId,
                'product_id' => $product['product']['id'],
                'count' => $product['count']
            ]);
        }
    }

    public static function getOrderId($userId, $dateTime) {
        $ids = Core::getInstance()->db->select(self::$tableName, '*', [
            'user_id' => $userId,
            'date' => $dateTime
        ]);
        if(isset($ids))
            return $ids[0]['id'];
        else
            return null;
    }
}