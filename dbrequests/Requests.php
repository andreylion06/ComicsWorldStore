<?php

namespace dbrequests;

class Requests
{
    private static function Request($request) {
        $pdo = new \PDO("mysql: host=localhost;dbname=comics_world", "root", "");
        $res = $pdo->query($request);
        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function SelectProducts($params): array
    {
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

        return self::Request($request);
    }

    public static function GetCountOfUsers()
    {
        $request = "SELECT COUNT(*) AS 'Count of Users' FROM user";
        return self::Request($request)[0]['Count of Users'];
    }

    public static function GetCountOfProducts()
    {
        $request = "SELECT COUNT(*) AS 'Count of Products' FROM product";
        return self::Request($request)[0]['Count of Products'];
    }

    public static function GetCountOfOrdersToday()
    {
        $request = "SELECT COUNT(*) AS 'Count of Orders' FROM user_order WHERE CONVERT(DATE, date) = CURDATE()";
        return self::Request($request)[0]['Count of Orders'];
    }

    public static function GetSalesInLastDays($countOfDays): array
    {
        $request = "SELECT DATE(date) AS date, COUNT(*) AS count FROM user_order GROUP BY DATE(date) ORDER BY DATE(date) DESC LIMIT 5;";
        return self::Request($request);
    }

    public static function GetPriceCategories(): array
    {
        $request = "
                    SELECT 
                      CASE
                        WHEN price < 1000 THEN 'Cheap (0 - 1000)'
                        WHEN price >= 1000 AND price <= 5000 THEN 'Medium (1000 - 5000)'
                        WHEN price > 5000 THEN 'Expensive (5000 - ...)'
                      END AS category,
                      COUNT(*) AS count
                    FROM product
                    GROUP BY category
                    ORDER BY
                      CASE category
                        WHEN 'Cheap (0 - 1000)' THEN 1
                        WHEN 'Medium (1000 - 5000)' THEN 2
                        WHEN 'Expensive (5000 - ...)' THEN 3
                      END;
                      ";

        return self::Request($request);
    }

    public static function GetBreadthOfBrands(): array
    {
        $request = "
                    SELECT brand.name AS brand, COUNT(product.id) AS count
                    FROM brand
                    JOIN product ON brand.id = product.brand_id
                    GROUP BY brand.id, brand.name;
                    ";
        return self::Request($request);
    }
}