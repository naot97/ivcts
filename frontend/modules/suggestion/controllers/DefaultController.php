<?php
namespace app\modules\suggestion\controllers;

use yii\web;
use yii\web\Controller;
use app\controllers\MyController;

class DefaultController extends MyController {
    
    public function actionIndex() {
    	parent::check();
        return $this->render('index');
    }
}
