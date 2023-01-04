<?php


namespace controllers;


use core\Controller;
use core\Core;
use models\Category;
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
    public function addAction($params) {
        $category_id = intval($params[0]);
        if (empty($category_id))
            $category_id = null;
        $categoriesList = Category::getCategories();
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['name'] = trim($_POST['name']);
            if (empty($_POST['name']))
                $errors['name'] = 'The name of the product is not specified';
            if (empty($_POST['category_id']))
                $errors['category_id'] = 'Category not selected';
            if ($_POST['price'] <= 0)
                $errors['price'] = 'The price is incorrectly set';
            if ($_POST['count'] <= 0)
                $errors['count'] = 'The number of products is incorrectly specified';

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
                    'category_id' => $category_id
                ]);
            }
        }
        return $this->render(null, [
            'categories' => $categoriesList,
            'category_id' => $category_id
        ]);
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
        $product = Product::getProductById($id);
        return $this->render(null, [
            'product' => $product
        ]);
    }
}