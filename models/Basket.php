<?php


namespace models;


use core\Core;

class Basket
{
    protected static $tableName = 'basket';
    public static function addProduct($product_id, $count = 1) {
        $rowProduct = Product::getById($product_id);
        $user_id = User::getCurrentAuthenticatedUser()['id'];
        if(isset($rowProduct)) {
            $rowBasket = Core::getInstance()->db->select(self::$tableName, '*', [
                'user_id' => $user_id,
                'product_id' => $product_id
            ])[0];
            if(isset($rowBasket)) {
                Core::getInstance()->db->update(self::$tableName, [
                    'count' => $rowBasket['count'] + $count
                ], [
                    'id' => $rowBasket['id']
                ]);
            }
            else {
                Core::getInstance()->db->insert(self::$tableName, [
                    'user_id' => $user_id,
                    'product_id' => $rowProduct['id'],
                    'count' => $count
                ]);
            }
        }
    }
    public static function getProducts() {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'user_id' => User::getCurrentAuthenticatedUser()['id']
        ]);
        $result = [];
        $products = [];
        $totalPrice = 0;
        foreach ($rows as $row) {
            $product = Product::getById($row['product_id']);
            $products [] = ['product' => $product, 'count' => $row['count']];
            if($row['count'] > $product['count'])
                continue;
            $totalPrice += $product['price'] * $row['count'];
        }
        $result['products'] = $products;
        $result['total_price'] = $totalPrice;
        return $result;
    }
    public static function getCountOfId($product_id) {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'user_id' => User::getCurrentAuthenticatedUser()['id'],
            'product_id' => $product_id
        ]);
        if(isset($rows))
            return $rows[0]['count'];
    }
    public static function clear() {
        Core::getInstance()->db->delete(self::$tableName, [
            'user_id' => User::getCurrentAuthenticatedUser()['id']
        ]);
    }
    public static function removeItem($product_id) {
        Core::getInstance()->db->delete(self::$tableName, [
            'user_id' => User::getCurrentAuthenticatedUser()['id'],
            'product_id' => $product_id
        ]);
    }
    public static function getCountItems() {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'user_id' => User::getCurrentAuthenticatedUser()['id']
        ]);
        if(isset($rows))
            return array_sum(array_column($rows, 'count'));
        else
            return 0;
    }
    public static function reduceOverflowItems() {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'user_id' => User::getCurrentAuthenticatedUser()['id']
        ]);
        foreach ($rows as $rowBasket) {
            $rowProduct = Product::getById($rowBasket['product_id']);
            if($rowBasket['count'] > $rowProduct['count']) {
                Core::getInstance()->db->update(self::$tableName, [
                    'count' => $rowProduct['count']
                ], [
                    'id' => $rowBasket['id']
                ]);
            }
        }
    }
    public static function isEnoughStock() {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'user_id' => User::getCurrentAuthenticatedUser()['id']
        ]);
        foreach ($rows as $rowBasket) {
            $rowProduct = Product::getById($rowBasket['product_id']);
            if($rowBasket['count'] > $rowProduct['count']) {
                return false;
            }
        }
        return true;
    }
}