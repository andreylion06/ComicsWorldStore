<?php
namespace models;

use core\Core;
use utils\Filter;

class Product
{
    protected static $tableName = 'product';
    public static function addProduct($row, $filePath) {
        $fieldaslist = ['name', 'photo', 'category_id', 'theme_id', 'price',
            'count', 'short_description', 'description', 'visible'];
        $row = Filter::filterArray($row, $fieldaslist);
        $row += ['photo' => $filePath];
        Core::getInstance()->db->insert(self::$tableName, $row);
    }

    public static function deleteProduct($id) {
        Core::getInstance()->db->delete(self::$tableName, [
            'id' => $id
        ]);
    }
    public static function updateProduct($id, $row) {
        $fieldaslist = ['name', 'category_id', 'price',
            'count', 'short_description', 'description', 'visible'];
        $row = Filter::filterArray($row, $fieldaslist);
        Core::getInstance()->db->update(self::$tableName, $row, [
           'id' => $id
        ]);
    }
    public static function getAllProducts() {
        $rows = Core::getInstance()->db->select(self::$tableName, '*');
        return array_reverse($rows);
    }
    public static function getById($id) {
        $row = Core::getInstance()->db->select(self::$tableName, '*', [
            'id' => $id
        ]);
        if(!empty($row))
            return $row[0];
        else
            return null;
    }
    public static function getProductsIn($tableName, $id) {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            $tableName.'_id' => $id
        ]);
        return array_reverse($rows);
    }
}