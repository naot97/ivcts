<?php
namespace app\modules\report\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use \yii\helpers\ArrayHelper;
use \yii\filters\VerbFilter;
use app\controllers\MyController;
use app\modules\report\models\periodModel;
class PeriodController extends MyController {     
    public $functionId = 13;
    
   /* public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'index' => ['GET'],
                        'get-spend-time-by' => ['POST'],
                        'get-logs' => ['POST'],
                        'create-spend-time' => ['POST'],
                        'update-spend-time' => ['POST'],
                        'delete-spend-time' => ['POST'],
                    ],
                ],
        ]);
    }   */   
    
    public function actionIndex() {
        $powerWrite =  $this->check();
        return $this->render('index',['powerWrite' => $powerWrite]);
    }
    
    public function actionGetSpendTimeBy() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'lstSpendTime' => periodModel::getSpendTimePlanBy($params),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionGetProject(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'lstProject' => periodModel::getProjectOfSpendTimeBy($params),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    public function actionGetSection(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'section' => periodModel::getSectionOfSpendTimeBy($params),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
}
