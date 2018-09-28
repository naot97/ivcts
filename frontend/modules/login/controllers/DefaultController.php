<?php
namespace app\modules\login\controllers;

use yii\web;
use yii;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Employee;

class DefaultController extends Controller {
   /* public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['POST'],
                ],
            ],
        ];
    }*/

    public function actionIndex() {

    	$model = new LoginForm();
    	if ($model->load(Yii::$app->request->post()))  
            if ($model->login()) return $this->redirect(Yii::$app->request->baseUrl .'/dashboard');
        return $this->render('index',['model' => $model]);


    }
}
