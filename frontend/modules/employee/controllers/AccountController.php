<?php
namespace app\modules\employee\controllers;

use yii\web;
use yii\web\Controller;
use app\controllers\MyController;
use Yii;
class AccountController extends MyController {
    public $functionId = 10;
    public function actionIndex() {
    	parent::check();
        return $this->render('index');
    }
}
