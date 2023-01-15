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
    public static function getById($tableName, $id) {
        $rows = Core::getInstance()->db->select($tableName, '*', [
            'id' => $id
        ]);
        if(!empty($rows))
            return $rows[0];
        else
            return null;
    }
    public static function getNameById($tableName, $id) {
        $row = self::getById($tableName, $id);
        if(!empty($row))
            return $row['name'];
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
        $rows = array_reverse($rows);
        return $rows;
    }
    public static function getSortedItems($tableName) {
        $rows = self::getItems($tableName);
        $name = array_column($rows, 'name');
        array_multisort($name, SORT_ASC, $rows);
        // Move 'Default' item to the first place
        $i = 0;
        foreach ($rows as $key => $value) {
            if($value['name'] === 'Default') {
                $default = $rows[$i];
                unset($rows[$key]);
                $rows = array($default) + $rows;
                break;
            }
            $i++;
        }
        return $rows;
    }
}
