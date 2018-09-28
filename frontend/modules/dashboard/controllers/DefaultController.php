<?php
namespace app\modules\dashboard\controllers;

use yii\web;
use yii\base\Controller;
use app\controllers\MyController;
class DefaultController extends Controller {
    public function actionIndex() {
        return $this->render('index');
    }
}
