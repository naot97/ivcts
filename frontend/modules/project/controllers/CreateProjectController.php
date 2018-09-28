<?php
namespace app\modules\project\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use \yii\helpers\ArrayHelper;
use \yii\filters\VerbFilter;
use app\modules\project\models\ProjectModel;
use app\modules\project\models\ProjectGroupModel;
use app\controllers\MyController;
use common\models\Power;
class CreateProjectController extends MyController {
    private $projectModel;
    private $projectGroupModel;    
    public $functionId = 7;
    public function __construct($id, $module, $config = array()) {

      //  throw new Exception("Error Processing Request", 1);
        if($this->projectModel === null) {
            $this->projectModel = new ProjectModel(1);
        }
        
        if($this->projectGroupModel === null) {
            $this->projectGroupModel = new ProjectGroupModel();
        }
        parent::__construct($id, $module, $config);
    }
    
    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'index' => ['GET'],
                        'get-list-project-by' => ['POST'],
                        'get-logs' => ['POST'],
                        'create-project' => ['POST'],
                        'update-project' => ['POST'],
                        'delete-project' => ['POST'],
                        'create-group-project' => ['POST'],
                        'update-group-project' => ['POST'],
                        'delete-group-project' => ['POST'],
                    ],
                ],
        ]);
    }
    
    public function actionIndex() {  
        $powerWrite =  parent::check();
        return $this->render('index',['powerWrite' => $powerWrite]);
    }
    
    public function actionGetListProjectBy() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'lstProject' => $this->projectModel->getProjectBy($params),
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
                'lstLogs' => $this->projectModel->getLogs($params),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    /************************************POST PROJECT**********************************************/
    
    public function actionCreateProject() {  
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->projectModel->insProject($params)) {
                return [
                    'message' => 'Create new project successfully',
                    'error' => 0,
                ];
            } 
            return [
                'message' => 'Create new project unsuccessfully',
                'error' => 1,
            ];
        } catch (Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionUpdateProject() {  
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->projectModel->updProjectBy($params)) {
                return [
                    'message' => 'Update project successfully',
                    'error' => 0,
                ];
            } 
            return [
                'message' => 'Update project unsuccessfully',
                'error' => 1,
            ];
        } catch (Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionDeleteProject() {  
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->projectModel->delProjectBy($params)) {
                return [
                    'message' => 'Delete project successfully',
                    'error' => 0,
                ];
            } 
            return [
                'message' => 'Delete project unsuccessfully',
                'error' => 1,
            ];
        } catch (Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    /************************************POST GROUP PROJECT**********************************************/
    
    public function actionCreateGroupProject() {  
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->projectGroupModel->insProjectGroup($params)) {
                return [
                    'message' => 'Create new group successfully',
                    'error' => 0,
                ];
            } 
            return [
                'message' => 'Create new group unsuccessfully',
                'error' => 1,
            ];
        } catch (\yii\db\Exception $exc) {
            $message = '';
            switch ($exc->getCode()) {
                case 23000:  
                    $message = '<b>Group</b> is existence';
                    break;
            }
            return [
                'message' => $message,
                'error' => 1,
            ];
        } catch (Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionUpdateGroupProject() {  
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->projectGroupModel->updProjectGroupBy($params)) {
                return [
                    'message' => 'Update group successfully',
                    'error' => 0,
                ];
            } 
            return [
                'message' => 'Update group unsuccessfully',
                'error' => 1,
            ];
        } catch (\yii\db\Exception $exc) {
            $message = '';
            switch ($exc->getCode()) {
                case 23000:  
                    $message = '<b>Group</b> is existence';
                    break;
            }
            return [
                'message' => $message,
                'error' => 1,
            ];
        } catch (Exception $exc) {   
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionDeleteGroupProject() {  
        Yii::$app->response->format = Response::FORMAT_JSON;     
        try { 
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->projectGroupModel->delProjectGroupBy($params)) {
                return [
                    'message' => 'Delete group successfully',
                    'error' => 0,
                ];
            } 
            return [
                'message' => 'Delete group unsuccessfully',
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
