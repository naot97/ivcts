<?php
namespace app\modules\register\controllers;

use yii\web;
use yii\web\Controller;
use app\modules\register\models\RegisterForm;
use common\models\Account;
use yii\filters\VerbFilter;
use yii;
class DefaultController extends Controller {
    /*public function behaviors()
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
    	$model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()))
    	   $model->regist();
        return $this->render('index',['model' => $model]);
    }
}
