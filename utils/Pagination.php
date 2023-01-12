<?php


namespace utils;


class Pagination
{
    public static function GetStylingArray($page, $count, $totalNumber) {
        if($page == 1) {
            $paginationNums = [1 => 'active', 2 => null, 3 => null];
            $next = 2;
            $previous = 'disabled';
        }
        else if($page == $page * $count >= $totalNumber) {
            $paginationNums = [
                $page - 2 => null,
                $page - 1 => null,
                $page => 'active'];
            $next = 'disabled';
            $previous = $page - 1;
        }
        else {
            $paginationNums = [
                $page - 1 => null,
                $page => 'active',
                $page + 1 => null
            ];
            $next = $page + 1;
            $previous = $page - 1;
        }

        if ($totalNumber > $count && $totalNumber <= $count * 2) {
            $paginationNums = [1 => null, 2 => null, 3 => 'disabled'];
            $paginationNums[$page] = 'active';
        }
        else if($totalNumber <= $count) {
            $paginationNums = [1 => 'active', 2 => 'disabled', 3 => 'disabled'];
            $next = 'disabled';
            $previous = 'disabled';
        }

        if($totalNumber == 0) {
            $paginationNums = [1 => 'disabled', 2 => 'disabled', 3 => 'disabled'];
            $next = 'disabled';
            $previous = 'disabled';
        }
        return [
            'previous' => $previous,
            'paginationNums' => $paginationNums,
            'next' => $next
        ];
    }
}