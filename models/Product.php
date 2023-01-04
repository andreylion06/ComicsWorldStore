<?php
namespace models;

use core\Core;
use core\Utils;

class Product
{
    protected static $tableName = 'product';
    public static function addProduct($row) {
        do {
            $fileName = uniqid().'.jpg';
            $newPath = "files/product/{$fileName}";
        } while(file_exists($newPath));

        $fieldaslist = ['name', 'photo', 'category_id', 'price',
            'count', 'short_description', 'description', 'visible'];
        $row = Utils::filterArray($row, $fieldaslist);
        $row += ['photo' => $fileName];
        move_uploaded_file($_FILES['file']['tmp_name'], $newPath);
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
        $row = Utils::filterArray($row, $fieldaslist);
        Core::getInstance()->db->update(self::$tableName, $row, [
           'id' => $id
        ]);
    }
    public static function getAllProducts() {
        $rows = Core::getInstance()->db->select(self::$tableName, '*');
        return array_reverse($rows);
    }
    public static function getProductById($id) {
        $row = Core::getInstance()->db->select(self::$tableName, '*', [
            'id' => $id
        ]);
        if(!empty($row))
            return $row[0];
        else
            return null;
    }
    public static function getProductsInCategory($category_id) {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'category_id' => $category_id
        ]);
        return $rows;
    }
}