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
        $dataClasses = ['Category', 'Theme', 'Personage', 'Brand'];
        $className = ucfirst($nameOfSection);
        $methodName = 'getById';
        if(in_array($className, $dataClasses))
            $row = call_user_func('\\models\\DataTable'.'::'.$methodName, $className, $id);
        else
            $row = call_user_func('\\models\\'.$className.'::'.$methodName, $className);
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