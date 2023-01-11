<?php
namespace models;

use core\Core;
use utils\Filter;

class Product
{
    protected static $tableName = 'product';
    public static function addProduct($row, $filePath) {
        $fieldaslist = ['name', 'photo', 'category_id', 'theme_id', 'personage_id',
            'brand_id', 'price', 'count', 'short_description', 'description', 'visible'];
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
        $fieldaslist = ['name', 'photo', 'category_id', 'theme_id', 'personage_id',
            'brand_id', 'price', 'count', 'short_description', 'description', 'visible'];
        $row = Filter::filterArray($row, $fieldaslist);
        Core::getInstance()->db->update(self::$tableName, $row, [
           'id' => $id
        ]);
    }
    public static function getAllProducts() {
        $rows = Core::getInstance()->db->select(self::$tableName, '*');
        return array_reverse($rows);
    }
    public static function count() {
        return count(self::getAllProducts());
    }
    public static function getOnePage($rows, $currentPage, $count) {
        $startItem = ($currentPage - 1) * $count;
        $pageItems = array_slice($rows, $startItem, $count);
        return $pageItems;
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
    public static function setDefaultForNull($column, $id) {
        $row = self::getById($id);
        $row["{$column}_id"] = 1;
        self::updateProduct($row['id'], $row);
    }
    public static function search($searchString, $all) {
        $conditionsArray = [
            'name' => "%{$searchString}%"
        ];
        if(!$all)
            $conditionsArray += ['visible' => 1];
        $rows = Core::getInstance()->db->select(self::$tableName, '*', $conditionsArray, 'LIKE');
        return array_reverse($rows);
    }
}