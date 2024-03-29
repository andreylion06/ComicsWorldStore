<?php


namespace controllers;


use core\Controller;
use core\Core;
use models\DataTable;
use models\Product;
use models\User;
use utils\Photo;
use dbrequests\Requests;

class ProductController extends Controller
{
    public function indexAction() {
        if(isset($_GET['page']))
            $page = intval($_GET['page']);
        else
            $page = 1;
        $countPerPage = 12;

        $requestParams = ['search' => $_GET['search']];

        if(!empty($_GET['category']))
            $requestParams['category'] = $_GET['category'];

        if(!empty($_GET['brand']))
            $requestParams['brand'] = $_GET['brand'];

        if(!empty($_GET['theme']))
            $requestParams['theme'] = $_GET['theme'];

        if(!empty($_GET['personage']))
            $requestParams['personage'] = $_GET['personage'];

        if(!empty($_GET['min']) && !empty($_GET['max'])) {
            if($_GET['min'] > $_GET['max']) {
                $tmp = $_GET['min'];
                $_GET['min'] = $_GET['max'];
                $_GET['max'] = $tmp;
            }
        }

        if(!empty($_GET['min']))
            $requestParams['min'] = $_GET['min'];

        if(!empty($_GET['max']))
            $requestParams['max'] = $_GET['max'];

        if(!User::isAdmin())
            $requestParams['visible'] = 1;

        $rows = Requests::SelectProducts($requestParams);
        $products = Product::getOnePage($rows, $page, $countPerPage);
        $categories = DataTable::getItems('category');
        $brands = DataTable::getItems('brand');
        $themes = DataTable::getItems('theme');
        $personages = DataTable::getItems('personage');
        $totalNumber = count($rows);


        if(($page - 1) * $countPerPage > $totalNumber || $page <= 0)
            return $this->error(404);

        return $this->render(null, [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'themes' => $themes,
            'personages' => $personages,
            'pagination' => [
                'page' => $page,
                'count' => $countPerPage,
                'totalNumber' => $totalNumber
            ],
            'requestParams' => $requestParams,
            'page' => $page
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
        if ($_POST['count'] < 0)
            $errors['count'] = 'The number of products is incorrectly specified';
        return $errors;
    }
    public function addAction($params) {
        $moduleName = $params[0];
        $module_id = intval($params[1]);
        if (empty($module_id))
            $module_id = null;

        $categoriesList = DataTable::getSortedItems('category');
        $themesList = DataTable::getSortedItems('theme');
        $personagesList = DataTable::getSortedItems('personage');
        $brandsList = DataTable::getSortedItems('brand');
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = $this->getInputErrors();

            if (empty($errors)) {
                $fileName = Photo::loadPhoto('product', $_FILES['file']['tmp_name']);
                Product::add($_POST, $fileName);
                $this->redirect('/product');
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
                    Product::update($id, $_POST);
                    if(!empty($_FILES['file']['tmp_name']))
                        Photo::changePhoto('product', $id, $_FILES['file']['tmp_name']);
                    $this->redirect("/product/view/{$id}");
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
            Product::delete($id);
            $this->redirect('/product/index');
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
    public function searchAction($params) {
        $searchString = $params[0];
        $rows = Product::search($searchString);
    }
}