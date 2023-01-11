<?php


namespace models;


use core\Core;
use utils\Filter;

class Order
{
    protected static $tableName = 'user_order';
    public static function addOrder($row) {
        $products = $row['products'];
        
        $fieldsList = ['date', 'user_id', 'name',
            'phone', 'city', 'post_number', 'total_price'];
        $rowOrder = Filter::filterArray($row, $fieldsList);
        Core::getInstance()->db->insert(self::$tableName, $rowOrder);

        $orderId = self::getOrderId($rowOrder['user_id'], $rowOrder['date']);
        foreach ($products as $product) {
            $product['product']['count'] -= $product['count'];
            Product::update($product['product']['id'], $product['product']);
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
    public static function getUserOrdersById($userId) {
        $orders = Core::getInstance()->db->select(self::$tableName, '*', [
            'user_id' => $userId
        ]);
        return $orders;
    }
    public static function getOrdersInProcess() {
        $orders = Core::getInstance()->db->select(self::$tableName, '*', [
            'status' => 'in processing'
        ]);
        return $orders;
    }
    public static function approve($id) {
        Core::getInstance()->db->update(self::$tableName, [
            'status' => 'approved'
        ],[
            'id' => $id
        ]);
    }
    public static function getOrderItems($order_id) {
        $rows = Core::getInstance()->db->select('order_item', '*', [
            'order_id' => $order_id
        ]);
        $products = [];
        foreach ($rows as $row) {
            $product = Product::getById($row['product_id']);
            $products [] = ['product' => $product, 'count_in_order' => $row['count']];
        }
        return $products;
    }
}