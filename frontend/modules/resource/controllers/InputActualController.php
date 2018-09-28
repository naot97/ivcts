<?php
namespace app\modules\resource\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use \yii\helpers\ArrayHelper;
use \yii\filters\VerbFilter;
use app\modules\resource\models\SpendTimeActualModel;
use app\controllers\MyController;

class InputActualController extends MyController {
    private $spendTimeActualModel;
    public $functionId = 6;
    public function __construct($id, $module, $config = array()) {
        $employeeID = 1;
        if($this->spendTimeActualModel === null) {
            $this->spendTimeActualModel = new SpendTimeActualModel($employeeID);
        }
        parent::__construct($id, $module, $config);
    }
    
    public function behaviors() {
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
    }    
    
    public function actionIndex() {
        $powerWrite =  $this->check();
        return $this->render('index',['powerWrite' => $powerWrite]);
    }
    
    public function actionGetSpendTimeBy() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'lstSpendTime' => $this->spendTimeActualModel->getSpendTimeActualBy($params),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionGetLogs() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'lstLogs' => $this->spendTimeActualModel->getLogs($params),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionCreateSpendTime() {  
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->spendTimeActualModel->insSpendTimeActual($params)) {
                return [
                    'message' => 'Create new spend time actual successfully',
                    'error' => 0,
                ];
            } 
            return [
                'message' => 'Create new spend time actual unsuccessfully',
                'error' => 1,
            ];
        } catch (Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionUpdateSpendTime() {  
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->spendTimeActualModel->updSpendTimeActual($params)) {
                return [
                    'message' => 'Update spend time actual successfully',
                    'error' => 0,
                ];
            } 
            return [
                'message' => 'Update spend time actual unsuccessfully',
                'error' => 1,
            ];
        } catch (Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionDeleteSpendTime() {  
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->spendTimeActualModel->delSpendTimeActual($params)) {
                return [
                    'message' => 'Delete spend time actual successfully',
                    'error' => 0,
                ];
            } 
            return [
                'message' => 'Delete spend time actual unsuccessfully',
                'error' => 1,
            ];
        } catch (Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
}
