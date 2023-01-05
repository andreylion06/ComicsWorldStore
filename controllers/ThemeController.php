<?php


namespace controllers;
use \core\Controller;
use core\Core;


class ThemeController extends Controller
{
    public static $tableName = 'theme';
    public function indexAction() {
        return DataController::indexAction($this, self::$tableName);
    }
    public function addAction() {
        return DataController::addAction($this, self::$tableName);
    }
    public function deleteAction($params) {
        $id = $params[0];
        $answer = ($params[1] === 'yes');
        return DataController::deleteAction($this, self::$tableName, $id, $answer);
    }
    public function editAction($params) {
        $id = $params[0];
        return DataController::editAction($this, self::$tableName, $id);
    }
    public function viewAction($params) {
        $id = $params[0];
        return DataController::viewAction($this, self::$tableName, $id);
    }
}