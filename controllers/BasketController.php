<?php


namespace controllers;


use core\Controller;
use models\Basket;
use models\Product;
use models\User;

class BasketController extends Controller
{
    public function indexAction($params) {
        if(!User::isUserAuthenticated())
            $this->redirect('/user/login');

        $id = intval($params[0]);

        $basket = Basket::getProducts();
        return $this->render(null, [
            'basket' => $basket
        ]);
    }
    public function addAction($params) {
        if(!User::isUserAuthenticated())
            $this->redirect('/user/login');

        $id = intval($params[0]);
        $product = Product::getById($id);
        if(isset($product)) {
            Basket::addProduct($id);
            $this->redirect('/basket');
        }
    }
    public function deleteAction($params) {
        if(!User::isUserAuthenticated())
            $this->redirect('/user/login');

        $id = intval($params[0]);
        Basket::removeItem($id);
        $this->redirect('/basket');
    }
    public function reduceAction() {
        Basket::reduceOverflowItems();
        $this->redirect('/basket');
    }
}