<?php


namespace utils;


class Filter
{
    public static function filterArray($array, $fieldsList) {
        $newArray = [];
        foreach ($array as $key => $value)
            if (in_array($key, $fieldsList))
                $newArray[$key] = $value;
        return $newArray;
    }
}