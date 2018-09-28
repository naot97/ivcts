<?php
namespace app\modules\dashboard\controllers;

use yii\web;
use app\controllers\BackendController;
class DefaultController extends BackendController {
    
    public function actionIndex() {
    	$this->checkAdminLogin();
        return $this->render('index');
    }
}
