<?php
namespace app\modules\employee\controllers;

use yii\web;
use yii\web\Controller;
use app\controllers\MyController;
use Yii;
class ManageController extends MyController {
    public $functionId = 9;
    public function actionIndex() {
    	parent::check();
        return $this->render('index');
    }
}
