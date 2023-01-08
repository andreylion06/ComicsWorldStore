<?php


namespace controllers;
use \core\Controller;
use core\Core;
use models\DataTable;
use models\Product;
use models\User;
use utils\Photo;


class DataController extends Controller
{
    public static function indexAction($controller, $moduleName) {
        $rows = DataTable::getItems($moduleName);
        foreach ($rows as &$row)
            $row += array('products_count' => count(self::getProductsIn($moduleName, $row['id'])));

        return $controller->render(null, [
            'moduleName' => $moduleName,
            'rows' => $rows
        ]);
    }
    public static function addAction($controller, $moduleName)
    {
        if (!User::isAdmin())
            return $controller->error(403);
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['name'] = trim($_POST['name']);
            if (empty($_POST['name']))
                $errors['name'] = "The name of the {$moduleName} is not specified";
            if (empty($errors)) {
                $fileName = Photo::loadPhoto($moduleName, $_FILES['file']['tmp_name']);
                DataTable::addItem($moduleName, $_POST['name'], $fileName);
                return $controller->redirect("/{$moduleName}/index");
            } else {
                $model = $_POST;
                return $controller->render("views/{$moduleName}/add.php", [
                    'moduleName' => $moduleName,
                    'errors' => $errors,
                    'model' => $model
                ]);
            }
        }
        return $controller->render(null, [
            'moduleName' => $moduleName
        ]);
    }
    public static function deleteAction($controller, $moduleName, $id, $answer) {
        if(!User::isAdmin())
            return $controller->error(403);
        if($id > 0) {
            $row = DataTable::getById($moduleName, $id);
            if($answer) {
                $filePath = "files/{$moduleName}/{$row['photo']}";
                if(is_file($filePath)) {
                    unlink($filePath);
                }
                $products = Product::getProductsIn($moduleName, $id);
                foreach ($products as $product) {
                    Product::setDefaultForNull($moduleName, $product['id']);
                }
                Photo::deletePhoto($moduleName, $id);
                DataTable::deleteItem($moduleName, $id);
                return $controller->redirect("/{$moduleName}/index");
                
            }
            return $controller->render(null, [
                'moduleName' => $moduleName,
                'row' => $row
            ]);
        } else
            return $controller->error(403);
    }
    public static function editAction($controller, $moduleName, $id) {
        if(!User::isAdmin())
            return $controller->error(403);
        if($id > 0) {
            $row = DataTable::getById($moduleName, $id);
            if(Core::getInstance()->requestMethod === 'POST') {
                $errors = [];
                $_POST['name'] = trim($_POST['name']);
                if (empty($_POST['name']))
                    $errors['name'] = "The name of the {$moduleName} is not specified";

                if (empty($errors)) {
                    DataTable::updateItem($moduleName, $id, $_POST['name']);
                    if(!empty($_FILES['file']['tmp_name']))
                        Photo::changePhoto($moduleName, $id, $_FILES['file']['tmp_name']);
                    return $controller->redirect("/{$moduleName}/index");
                } else {
                    $model = $_POST;
                    return $controller->render(null, [
                        'moduleName' => $moduleName,
                        'errors' => $errors,
                        'model' => $model,
                        'row' => $row
                    ]);
                }
            }
            return $controller->render(null, [
                'moduleName' => $moduleName,
                'row' => $row
            ]);
        } else
            return $controller->error(403);
    }
    public static function viewAction($controller, $moduleName, $id) {
        $row = DataTable::getById($moduleName, $id);
        $products = self::getProductsIn($moduleName, $id);
        return $controller->render(null, [
            'moduleName' => $moduleName,
            'row' => $row,
            'products' => $products
        ]);
    }

    public static function getProductsIn($moduleName, $id) {
        $className = 'Product';
        $methodName = 'getProductsIn';
        $products = call_user_func('\\models\\'.$className.'::'.$methodName, $moduleName, $id);
        return $products;
    }
}