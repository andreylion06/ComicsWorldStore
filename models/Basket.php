<?php


namespace models;


class Basket
{
    public static function addProduct($product_id, $count = 1) {
        if (!is_array($_SESSION['basket']))
            $_SESSION['basket'] = [];
        $row = Product::getById($product_id);
        if($_SESSION['basket'][$product_id] + $count <= $row['count'])
            $_SESSION['basket'][$product_id] += $count;
    }
    public static function getProducts() {
        if (is_array($_SESSION['basket'])) {
            $result = [];
            $products = [];
            $totalPrice = 0;
            foreach ($_SESSION['basket'] as $product_id => $count) {
                $product = Product::getById($product_id);
                if($product['count'] == 0)
                    $count = 0;
                $totalPrice += $product['price'] * $count;
                $products [] = ['product' => $product, 'count' => $count];
            }
            $result['products'] = $products;
            $result['total_price'] = $totalPrice;
            return $result;
        }
        return null;
    }
    public static function clear() {
        unset($_SESSION['basket']);
    }
    public static function isItemInBasket($id) {
        if(!User::isUserAuthenticated())
            return null;
        return isset($_SESSION['basket'][$id]);
    }
    public static function removeItem($id) {
        unset($_SESSION['basket'][$id]);
    }
    public static function getCountItems() {
        $rows = self::getProducts();
        if(isset($rows['products']))
            return array_sum(array_column($rows['products'], 'count'));
        else
            return 0;
    }
    public static function getCountOfId($id) {
        return $_SESSION['basket'][$id];
    }
}