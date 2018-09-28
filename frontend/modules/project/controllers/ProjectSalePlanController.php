<?php
namespace app\modules\project\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use \yii\helpers\ArrayHelper;
use \yii\filters\VerbFilter;
use app\modules\project\models\ProjectSalePlanModel;
use app\controllers\MyController;

class ProjectSalePlanController extends MyController {        
    private $projectSalePlanModel; 
    public $functionId = 8;
    public $position;
    public function __construct($id, $module, $config = array()) {    
        
        if($this->projectSalePlanModel === null) {
            $this->projectSalePlanModel = new ProjectSalePlanModel(1);
        }
        parent::__construct($id, $module, $config);
    }
    
    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'index' => ['GET'],
                        'get-project-saleplan-by' => ['POST'],
                        'get-logs' => ['POST'],
                        'create-project-saleplan' => ['POST'],
                        'update-project-saleplan' => ['POST'],
                        'delete-project-saleplan' => ['POST'],
                        'copy-data-new-period' => ['POST'],
                    ],
                ],
        ]);
    }    
    
    public function actionIndex($p) {     
        Yii::$app->session['position'] = ($p==='1' ? 'SDC' : 'PM');
        $this->view->title = 'Project Sale Plan' . ($p==='1' ? ' For SDC' : ' For PM');
        $this->position = ($p==='1' ? 'SDC' : 'PM');
        $this->functionId = ($p==='1' ? 8 : 15);
        $powerWrite = parent::check();
        return $this->render('index',['powerWrite' => $powerWrite]);
    }
    
    public function actionGetProjectSaleplanBy() {
        $this->projectSalePlanModel->setPosition(Yii::$app->session->get('position'));
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'lstProjectSaleplan' => $this->projectSalePlanModel->getProjectSaleplanBy($params),
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
                'lstLogs' => $this->projectSalePlanModel->getLogs($params),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionCreateProjectSaleplan() {  
        $this->projectSalePlanModel->setPosition(Yii::$app->session->get('position'));
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->projectSalePlanModel->insProjectSaleplan($params)) {
                return [
                    'message' => 'Create new project sale plan successfully',
                    'error' => 0,
                    'position' => $this->position,
                ];
            } 
            return [
                'message' => 'Create new project sale plan unsuccessfully',
                'error' => 1,
            ];
        } catch (Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionUpdateProjectSaleplan() {  

        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $this->projectSalePlanModel->setPosition(Yii::$app->session->get('position'));
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->projectSalePlanModel->updProjectSaleplan($params)) {
                return [
                    'message' => 'Update project sale plan successfully',
                    'error' => 0,
                ];
            } 
            return [
                'message' => 'Update project sale plan unsuccessfully',
                'error' => 1,
            ];
        } catch (Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionDeleteProjectSaleplan() {  
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->projectSalePlanModel->delProjectSaleplan($params)) {
                return [
                    'message' => 'Delete project sale plan successfully',
                    'error' => 0,
                ];
            } 
            return [
                'message' => 'Delete project sale plan unsuccessfully',
                'error' => 1,
            ];
        } catch (Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionCopyDataNewPeriod() {  
        $this->projectSalePlanModel->setPosition(Yii::$app->session->get('position'));
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->projectSalePlanModel->copyNewDataPeriod($params) > 0) {
                return [
                    'message' => 'Copy new data successfully',
                    'error' => 0,

                ];
            } 
            return [
                'message' => 'Copy new data unsuccessfully',
                'error' => 1,
            ];
        } catch (\Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
}
