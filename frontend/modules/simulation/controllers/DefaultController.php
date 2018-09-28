<?php
namespace app\modules\simulation\controllers;

use yii\web;
use yii\web\Controller;
use app\controllers\MyController;

class DefaultController extends MyController {
    
    public function actionIndex() {
    	parent::check();
        return $this->render('index');
    }
}
