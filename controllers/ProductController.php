<?php


namespace controllers;


use core\Controller;
use core\Core;
use models\DataTable;
use models\Product;
use models\User;
use utils\Photo;

class ProductController extends Controller
{
    public function indexAction() {
        $products = Product::getAllProducts();
        return $this->render(null, [
            'products' => $products
        ]);
        return $this->render();
    }
    public function getInputErrors() {
        $errors = [];
        $_POST['name'] = trim($_POST['name']);
        if (empty($_POST['name']))
            $errors['name'] = 'The name of the product is not specified';
        if (empty($_POST['category_id']))
            $errors['category_id'] = 'Category not selected';
        if (empty($_POST['theme_id']))
            $errors['theme_id'] = 'Theme not selected';
        if ($_POST['price'] <= 0)
            $errors['price'] = 'The price is incorrectly set';
        if ($_POST['count'] <= 0)
            $errors['count'] = 'The number of products is incorrectly specified';
        return $errors;
    }
    public function addAction($params) {
        $moduleName = $params[0];
        $module_id = intval($params[1]);
        if (empty($module_id))
            $module_id = null;
        $personagesList = DataTable::getSortedItems('personage');

        $categoriesList = DataTable::getSortedItems('category');
        $themesList = DataTable::getSortedItems('theme');
        $brandsList = DataTable::getSortedItems('brand');
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = $this->getInputErrors();

            if (empty($errors)) {
                $fileName = Photo::loadPhoto('product', $_FILES['file']['tmp_name']);
                Product::addProduct($_POST, $fileName);
                return $this->redirect('/product');
            } else {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model,
                    'categories' => $categoriesList,
                    'themes' => $themesList,
                    'personages' => $personagesList,
                    'brands' => $brandsList,
                    $moduleName.'_id' => $module_id
                ]);
            }
        }
        return $this->render(null, [
            'categories' => $categoriesList,
            'themes' => $themesList,
            'personages' => $personagesList,
            'brands' => $brandsList,
            $moduleName.'_id' => $module_id
        ]);
    }
    public function editAction($params) {
        $id = $params[0];
        if(!User::isAdmin())
            return $this->error(403);
        if($id > 0) {
            $row = Product::getById($id);
            $categoriesList = DataTable::getSortedItems('category');
            $themesList = DataTable::getSortedItems('theme');
            $personagesList = DataTable::getSortedItems('personage');
            $brandsList = DataTable::getSortedItems('brand');
            if(Core::getInstance()->requestMethod === 'POST') {
                $errors = [];
                $_POST['name'] = trim($_POST['name']);
                $errors = $this->getInputErrors();

                if (empty($errors)) {
                    Product::updateProduct($id, $_POST);
                    if(!empty($_FILES['file']['tmp_name']))
                        Photo::changePhoto('product', $id, $_FILES['file']['tmp_name']);
                    return $this->redirect("/product");
                } else {
                    $model = $_POST;
                    return $this->render(null, [
                        'errors' => $errors,
                        'model' => $model,
                        'row' => $row,
                        'categories' => $categoriesList,
                        'themes' => $themesList,
                        'personages' => $personagesList,
                        'brands' => $brandsList
                    ]);
                }
            }
            return $this->render(null, [
                'row' => $row,
                'categories' => $categoriesList,
                'themes' => $themesList,
                'personages' => $personagesList,
                'brands' => $brandsList
            ]);
        } else
            return $this->error(403);
    }
    public function deleteAction($params) {
        $id = intval($params[0]);
        if(!User::isAdmin())
            return $this->error(403);
        if($id > 0) {
            Photo::deletePhoto('product', $id);
            Product::deleteProduct($id);
            return $this->redirect('/product/index');
        } else
            return $this->error(403);
    }
    public function viewAction($params) {
        $id = intval($params[0]);
        $product = Product::getById($id);
        return $this->render(null, [
            'product' => $product
        ]);
    }
}