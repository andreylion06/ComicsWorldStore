<?php
namespace models;

use core\Core;
use utils\Photo;

class  Category {
    protected static $tableName = 'category';
    public static function addCategory($name, $fileName) {
        Core::getInstance()->db->insert(self::$tableName, [
            'name' => $name,
            'photo' => $fileName
        ]);
    }
    public static function getCategoryById($id) {
        $rows = Core::getInstance()->db->select(self::$tableName, '*', [
            'id' => $id
        ]);
        if(!empty($rows))
            return $rows[0];
        else
            return null;
    }
    public static function deleteCategory($id) {
        $rows = Core::getInstance()->db->delete(self::$tableName, [
            'id' => $id
        ]);
    }
    public static function updateCategory($id, $newName) {
        $rows = Core::getInstance()->db->update(self::$tableName, [
            'name' => $newName
        ], [
            'id' => $id
        ]);
    }
    public static function getCategories() {
        $rows = Core::getInstance()->db->select(self::$tableName);
        return array_reverse($rows);
    }
}
