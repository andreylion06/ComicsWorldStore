<?php
namespace models;

use core\Core;
use utils\Photo;

class  DataTable {
    public static function addItem($tableName, $name, $fileName) {
        Core::getInstance()->db->insert($tableName, [
            'name' => $name,
            'photo' => $fileName
        ]);
    }
    public static function getItemById($tableName, $id) {
        $rows = Core::getInstance()->db->select($tableName, '*', [
            'id' => $id
        ]);
        if(!empty($rows))
            return $rows[0];
        else
            return null;
    }
    public static function deleteItem($tableName, $id) {
        $rows = Core::getInstance()->db->delete($tableName, [
            'id' => $id
        ]);
    }
    public static function updateItem($tableName, $id, $newName) {
        $rows = Core::getInstance()->db->update($tableName, [
            'name' => $newName
        ], [
            'id' => $id
        ]);
    }
    public static function getItems($tableName) {
        $rows = Core::getInstance()->db->select($tableName);
        return array_reverse($rows);
    }
}
