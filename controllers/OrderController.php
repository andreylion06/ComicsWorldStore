<?php


namespace controllers;


use core\Controller;
use core\Core;
use models\Basket;
use models\Order;
use models\User;

class OrderController extends Controller
{
    public function indexAction() {
        if(!User::isUserAuthenticated())
            $this->redirect('/user/login');
        $basket = Basket::getProducts();
        if(count($basket['products']) == 0 || !Basket::isEnoughStock())
            $this->redirect('/basket');

        $user = User::getCurrentAuthenticatedUser();
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];

            foreach ($_POST as $key => $value) {
                if(trim($value) == null) {
                    $errors[$key] = ucfirst(str_replace('_', ' ', $key)).' is not set';
                }
            }

            if(!preg_match("/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/", $_POST['phone'])) {
                $errors['phone'] = 'Phone number is invalid';
            }
            if(count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    'user' => $user,
                    'model' => $_POST,
                    'errors' => $errors
                ]);
            } else {
                $row = $_POST;
                $row += ['user_id' => User::getCurrentAuthenticatedUser()['id']];
                $row += ['date' => date("Y-m-d H:i:s")];
                $row += ['products' => Basket::getProducts()['products']];
                $row += ['total_price' => Basket::getProducts()['total_price']];

                Order::addOrder($row);
                Basket::clear();

                return $this->renderView('success');
            }
        } else
            return $this->render(null, [
                'user' => $user
            ]);
    }
}