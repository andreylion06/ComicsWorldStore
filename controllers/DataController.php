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
    public static function indexAction($controller, $tableName) {
        $rows = DataTable::getItem($tableName);
        if(User::isAdmin())
            $viewPath = "views/{$tableName}/index-admin.php";
        else
            $viewPath = "views/{$tableName}/index.php";

        return $controller->render($viewPath, [
            'rows' => $rows
        ]);
    }
    public static function addAction($controller, $tableName)
    {
        if (!User::isAdmin())
            return $controller->error(403);
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['name'] = trim($_POST['name']);
            if (empty($_POST['name']))
                $errors['name'] = "The name of the {$tableName} is not specified";
            if (empty($errors)) {
                $fileName = Photo::loadPhoto($tableName, $_FILES['file']['tmp_name']);
                DataTable::addItem($tableName, $_POST['name'], $fileName);
                return $controller->redirect("/{$tableName}/index");
            } else {
                $model = $_POST;
                return $controller->render("views/{$tableName}/add.php", [
                    'errors' => $errors,
                    'model' => $model
                ]);
            }
        }
        return $controller->render(null, [
            'tableName' => $tableName
        ]);
    }
    public static function deleteAction($controller, $tableName, $id, $answer) {
        if(!User::isAdmin())
            return $controller->error(403);
        if($id > 0) {
            $row = DataTable::getItemById($tableName, $id);
            if($answer) {
                $filePath = "files/{$tableName}/{$row['photo']}";
                if(is_file($filePath)) {
                    unlink($filePath);
                }
                Photo::deletePhoto($tableName, $id);
                DataTable::deleteItem($tableName, $id);
                return $controller->redirect("/{$tableName}/index");
                
            }
            return $controller->render(null, [
                'tableName' => $tableName,
                'row' => $row
            ]);
        } else
            return $controller->error(403);
    }
    public static function editAction($controller, $tableName, $id) {
        if(!User::isAdmin())
            return $controller->error(403);
        if($id > 0) {
            $row = DataTable::getItemById($tableName, $id);
            if(Core::getInstance()->requestMethod === 'POST') {
                $errors = [];
                $_POST['name'] = trim($_POST['name']);
                if (empty($_POST['name']))
                    $errors['name'] = "The name of the {$tableName} is not specified";

                if (empty($errors)) {
                    DataTable::updateItem($tableName, $id, $_POST['name']);
                    if(!empty($_FILES['file']['tmp_name']))
                        Photo::changePhoto($tableName, $id, $_FILES['file']['tmp_name']);
                    return $controller->redirect("/{$tableName}/index");
                } else {
                    $model = $_POST;
                    return $controller->render(null, [
                        'tableName' => $tableName,
                        'errors' => $errors,
                        'model' => $model,
                        'row' => $row
                    ]);
                }
            }
            return $controller->render(null, [
                'tableName' => $tableName,
                'row' => $row
            ]);
        } else
            return $controller->error(403);
    }
    public static function viewAction($controller, $tableName, $id) {
        $row = DataTable::getItemById($tableName, $id);
        $className = 'Product';
        $methodName = 'getProductsIn'.ucfirst($tableName);
        $products = call_user_func('\\models\\'.$className.'::'.$methodName, $id);
        return $controller->render(null, [
            $tableName => $row,
            'products' => $products
        ]);
    }
}