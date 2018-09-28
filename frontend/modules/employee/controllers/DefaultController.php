<?php
namespace app\modules\employee\controllers;

use yii\web;
use yii\web\Controller;
use app\controllers\MyController;
class DefaultController extends MyController {
    
    public function actionIndex() {
        return $this->render('index');
    }
}
