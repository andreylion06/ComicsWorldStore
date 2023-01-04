<?php


namespace controllers;
use \core\Controller;
use core\Core;
use models\Category;
use models\Product;
use models\User;
use utils\Photo;


class CategoryController extends Controller
{
    public function indexAction() {
        $rows = Category::getCategories();
        $viewPath = null;
        if(User::isAdmin())
            $viewPath = "views/category/index-admin.php";
        return $this->render($viewPath, [
            'rows' => $rows
        ]);
    }
    public function addAction($params)
    {
        if (!User::isAdmin())
            return $this->error(403);
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];
            $_POST['name'] = trim($_POST['name']);
            if (empty($_POST['name']))
                $errors['name'] = 'The name of the category is not specified';

            if (empty($errors)) {
                $fileName = Photo::loadPhoto('category', $_FILES['file']['tmp_name']);
                Category::addCategory($_POST['name'], $fileName);
                return $this->redirect('/category/index');
            } else {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            }
        }
        return $this->render();
    }
    public function deleteAction($params) {
        $id = intval($params[0]);
        $yes = boolval($params[1] === 'yes');
        if(!User::isAdmin())
            return $this->error(403);
        if($id > 0) {
            $category = Category::getCategoryById($id);
            if($yes) {
                $filePath = 'files/category/'.$category['photo'];
                if(is_file($filePath)) {
                    unlink($filePath);
                }
                Photo::deletePhoto('category', $id);
                Category::deleteCategory($id);
                return $this->redirect('/category/index');
                
            }
            return $this->render(null, [
                'category' => $category
            ]);
        } else
            return $this->error(403);
    }
    public function editAction($params) {
        $id = intval($params[0]);
        if(!User::isAdmin())
            return $this->error(403);
        if($id > 0) {
            $category = Category::getCategoryById($id);
            if(Core::getInstance()->requestMethod === 'POST') {
                $errors = [];
                $_POST['name'] = trim($_POST['name']);
                if (empty($_POST['name']))
                    $errors['name'] = 'The name of the category is not specified';

                if (empty($errors)) {
                    Category::updateCategory($id, $_POST['name']);
                    if(!empty($_FILES['file']['tmp_name']))
                        Photo::changePhoto('category', $id, $_FILES['file']['tmp_name']);
                    return $this->redirect('/category/index');
                } else {
                    $model = $_POST;
                    return $this->render(null, [
                        'errors' => $errors,
                        'model' => $model,
                        'category' => $category
                    ]);
                }
            }
            return $this->render(null, [
                'category' => $category
            ]);
        } else
            return $this->error(403);
    }
    public function viewAction($params) {
        $id = intval($params[0]);
        $category = Category::getCategoryById($id);
        $products = Product::getProductsInCategory($id);
        return $this->render(null, [
            'category' => $category,
            'products' => $products
        ]);
    }
}