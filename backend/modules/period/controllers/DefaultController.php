<?php
namespace app\modules\period\controllers;
use yii\web\Response;
use app\controllers\BackendController;
use common\Untils;
use yii;
use  app\modules\period\models\periodModel;
class DefaultController extends BackendController {
	
    public function actionIndex() {
          $this->checkAdminLogin();          
          return $this->render('index');	
        }
    public function actionGetPeriodListBy() {
        try{            
            Yii::$app->response->format = Response::FORMAT_JSON;
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'result' => periodModel::getListBy($params),
                'error' => 0,
            ];
        } 
        catch(\Exception $ex){
            return Untils::handleExceptionOfAngular($ex);
        }
    }

    public function actionSavePeriod(){
        try{    
            $model = new periodModel();        
            Yii::$app->response->format = Response::FORMAT_JSON;
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'error' => $model->savePeriod($params) ? 0 : 1,
                'message' => $model->errorMess
            ];
        } 
        catch(\Exception $ex){
            return Untils::handleExceptionOfAngular($ex);
        }
    }
}

