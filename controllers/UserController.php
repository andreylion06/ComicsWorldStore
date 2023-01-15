<?php


namespace controllers;

use core\Controller;
use core\Core;
use models\Order;
use models\User;

class UserController extends Controller
{
    public function registerAction() {
        if(User::isUserAuthenticated())
            $this->redirect('/');
        if (Core::getInstance()->requestMethod === 'POST') {
            $errors = [];

            if(!filter_var($_POST['login'], FILTER_VALIDATE_EMAIL))
                $errors['login'] = 'Error entering email';
            if(User::isLoginExists($_POST['login']))
                $errors['login'] = 'This login is busy <a href="/user/login">Login?</a>';

            if($_POST['password'] != $_POST['password2']) {
                $errors['password'] = 'Passwords do not match';
                $errors['password'] = 'Passwords do not match';
            }

            foreach ($_POST as $key => $value) {
                if(trim($value) == null) {
                    $errors[$key] = ucfirst($key).' is not set';
                }
            }

            if(count($errors) > 0) {
                $model = $_POST;
                return $this->render(null, [
                    'errors' => $errors,
                    'model' => $model
                ]);
            } else {
                User::addUser($_POST['login'], $_POST['password'], $_POST['firstname'], $_POST['lastname']);
                return $this->renderView('register-success');
            }
        } else
            return $this->render();
    }

    public function loginAction() {
        if(User::isUserAuthenticated())
            $this->redirect('/');
        if (Core::getInstance()->requestMethod === 'POST') {
            $user = User::getUserByLoginAndPassword($_POST['login'], $_POST['password']);
            $error = null;
            if(empty($user)) {
                $error = 'Incorrect login or password';
            } else {
                User::authenticateUser($user);
                $this->redirect('/');
            }
        }
        return $this->render(null, [
            'error' => $error
        ]);
    }

    public function logoutAction() {
        if(!User::isUserAuthenticated())
            $this->redirect('/user/login');

        User::logoutUser();
        $this->redirect('/');
    }

    public function indexAction() {
        if(!User::isUserAuthenticated())
            $this->redirect('/user/login');

        if(User::isAdmin())
            $orders = Order::getOrdersByStatus('in processing');
        else
            $orders = Order::getUserOrdersById(User::getCurrentAuthenticatedUser()['id']);

        return $this->render(null, [
            'orders' => $orders
        ]);
    }

    public function approveAction($params) {
        if (!User::isAdmin())
            return $this->error(403);

        $orderId = intval($params[0]);
        Order::approve($orderId);
        $this->redirect("/user");
    }
}