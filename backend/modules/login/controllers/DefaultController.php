<?php
namespace app\modules\login\controllers;

use yii\web;
use yii;
use yii\web\Controller;
use common\models\LoginForm;
use common\models\Account;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Employee;

class DefaultController extends Controller {
  
    public function actionIndex() {
    	$model = new LoginForm();    	
    	$model->load(Yii::$app->request->post());

    	if ($model->adminLogin()) return $this->redirect(Yii::$app->request->baseUrl.'/dashboard');
        return $this->render('index',['model' => $model]);


    }
}
