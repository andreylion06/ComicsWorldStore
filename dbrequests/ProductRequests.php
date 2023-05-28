<?php

namespace dbrequests;

class ProductRequests
{
    public static function Select($params) {
        $pdo = new \PDO("mysql: host=localhost;dbname=comics_world", "root", "");

        $request = "SELECT * FROM product WHERE";

        if(!empty($params['category']))
            $request = $request." category_id = '".$params['category']."' AND";

        if(!empty($params['brand']))
            $request = $request." brand_id = '".$params['brand']."' AND";

        if(!empty($params['theme']))
            $request = $request." theme_id = '".$params['theme']."' AND";

        if(!empty($params['personage']))
            $request = $request." personage_id = '".$params['personage']."' AND";

        if(!empty($params['visible']))
            $request = $request." visible = '".$params['visible']."' AND";

        if(!empty($params['min']))
            $request = $request." price >= '".$params['min']."' AND";

        if(!empty($params['max']))
            $request = $request." price <= '".$params['max']."' AND";

        $request = $request." name LIKE '%".$params['search']."%' ORDER BY id DESC;";

//        var_dump($request);die;

        $res = $pdo->query($request);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }
}