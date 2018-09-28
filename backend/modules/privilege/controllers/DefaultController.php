<?php
namespace app\modules\privilege\controllers;
use yii\web\Response;
use app\controllers\BackendController;
use common\models\Account;
use common\models\Privilege;
use common\models\GroupForm;
use app\modules\privilege\models\priModel;
use app\modules\privilege\models\groupModel;
use yii;
use common\models\GroupPrivilege;

class DefaultController extends BackendController {
    public $priModel;
    public $groupModel;
    public function actionIndex() {
          $this->checkAdminLogin();
          return $this->render('index');    
        }
    public function __contruct(){
        $this->priModel = new priModel();
    }
    
    public function actionGetListPriBy(){

        $this->priModel = new priModel();
        Yii::$app->response->format = Response::FORMAT_JSON;        
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'lstPri' => $this->priModel->getlstPri($params),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }        
    }

    public function actionGetListGroup(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try{
            return[
                'lstGroup' => GroupPrivilege::find()->all(),
                'error' => 0,
            ];
        }
        catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }      
    }

    public function actionCreateGroup(){
        $this->groupModel = new groupModel();
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            $this->groupModel->create($params);
            return [
                'message' => 'Create Group Success <br>',
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }        
    }

    public function actionUpdateGroup(){
        $this->groupModel = new groupModel();
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->groupModel->updateGroup($params))
                return [
                    'message' => 'Update Group Success <br>',
                    'error' => 0,
                ];
            else 
                return[
                    'message' => 'Can\'t update anything <br>',
                    'error' => 1,   
                ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }        
    }

    public function actionDeleteGroup(){
        $this->groupModel = new groupModel();
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if (!$this->groupModel->isEmptyGroup($params))
                return[
                    'message' => 'Can\'t delete unempty group <br>',
                    'error' => 1,   
                ];
            if ($this->groupModel->deleteGroup($params))
                return [
                    'message' => 'Delete Group Success <br>',
                    'error' => 0,
                ];
            else 
                return[
                    'message' => 'Can\'t delete anything <br>',
                    'error' => 1,   
                ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }     
    }

    public function actionDeletePrivilege(){
        $this->priModel = new priModel();
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->priModel->deletePrivilege($params))  
                return [
                    'message' => 'Delete Privilege Success <br>',
                    'error' => 0,
                ];
            else 
                return [
                    'message' => 'Can\'t delete Privilege <br>',
                    'error' => 1,
                ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }        
    }

    public function actionCreatePrivilege(){
        $this->priModel = new priModel();
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->priModel->createPrivilege($params))
                return [
                    'message' => 'Create Privilege Success <br>',
                    'error' => 0,
                ];
            else 
                return [
                    'message' => 'Function Id have already taken <br>',
                    'error' => 0,
                ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }     
    }

    public function actionUpdatePrivilege(){
        $this->priModel = new priModel();
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            if ($this->priModel->updatePrivilege($params))
                return [
                    'message' => 'Update Privilege Success <br>',
                    'error' => 0,
                ];
            else 
                return [
                    'message' => 'Function Id have already taken<br>',
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

