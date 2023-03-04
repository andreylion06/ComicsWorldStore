<?php


namespace utils;


use core\Core;

class Photo
{
    public static function loadPhoto($nameOfSection, $photoPath): string
    {
        do {
            $fileName = uniqid().'.jpg';
            $newPath = "files/".$nameOfSection."/{$fileName}";
        } while(file_exists($newPath));

        move_uploaded_file($photoPath, $newPath);
        return $fileName;
    }
    public static function deletePhoto($nameOfSection, $id) {
        $className = ucfirst($nameOfSection);
        $methodName = 'getById';
        $row = call_user_func('\\models\\'.$className.'::'.$methodName, $id);
        $photoPath = 'files/'.$nameOfSection.'/'.$row['photo'];
        if (is_file($photoPath))
            unlink($photoPath);
    }
    public static function changePhoto($nameOfSection, $id, $newPhoto) {
        self::deletePhoto($nameOfSection, $id);
        $fileName = self::loadPhoto($nameOfSection, $newPhoto);
        Core::getInstance()->db->update($nameOfSection, [
            'photo' => $fileName
        ], [
            'id' => $id
        ]);
    }
}