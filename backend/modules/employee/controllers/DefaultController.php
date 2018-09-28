<?php
namespace app\modules\employee\controllers;
use yii\web\Response;
use app\controllers\BackendController;
use common\models\Section;
use common\models\Rank;
use common\models\Level;
use app\modules\employee\models\EmployeeModel;
use app\modules\employee\models\AccountModel;
use app\modules\employee\models\LogModel;

use yii;
use common\models\Employee;
use common\Untils;
use common\models\Department;

class DefaultController extends BackendController{
	public function actionIndex() {
        $this->checkAdminLogin();
        return $this->render('index');	
    }

    public function actionGetSectionList(){
    	Yii::$app->response->format = Response::FORMAT_JSON;
    	try{
    		$sectionList = Section::find()->where(['sectionStatus' => 1])->all();
    		return[
    			'result' => $sectionList,
    			'error' => 0
    		];
    	}
    	catch(\Excetion $ex){
    		return $this->handleExceptionOfAngular($ex);
    	}

    }
    public function actionGetRankList(){
    	Yii::$app->response->format = Response::FORMAT_JSON;
    	try{
    		return[
    			'result' =>  Rank::find()->where(['rankStatus' => 1])->all(),
    			'error' => 0
    		];
    	}
    	catch(\Excetion $ex){
    		return $this->handleExceptionOfAngular($ex);
    	}

    }
    public function actionGetLevelList(){
    	Yii::$app->response->format = Response::FORMAT_JSON;
    	try{
    		return[
    			'result' =>Level::find()->where(['levelStatus' => 1])->all(),
    			'error' => 0
    		];
    	}
    	catch(\Excetion $ex){
    		return $this->handleExceptionOfAngular($ex);
        }
    }

    public function actionGetAccountList(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try{
            $accountList = Employee::find()->all();
            return[
                'result' => $accountList,
                'error' => 0
            ];
        }
        catch(\Excetion $ex){
            return $this->handleExceptionOfAngular($ex); 
        }
    }

   public function actionGetEmployeeListBy(){
   	 	try {
	    	Yii::$app->response->format = Response::FORMAT_JSON;
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);

	    	$model = new EmployeeModel();
	    	$employeeList = $model->getEmployeeListBy($params);
	    	return [
	    		'result' => $employeeList,
	    		'error'	=> 0
	    	];
    	}
    	catch (\Excetion $ex){
    		return $this->handleExceptionOfAngular($ex);
    	}
    }

    public function actionCreateEmployee(){
        try{
            Yii::$app->response->format = Response::FORMAT_JSON;
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            $model = new EmployeeModel();

            return $model->createEmployee($params);
             
        }
        catch (\Excetion $ex){
            return $this->handleExceptionOfAngular($ex);
        }
    }

    public function actionUpdateEmployee(){
        try{
            Yii::$app->response->format = Response::FORMAT_JSON;
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            $model = new EmployeeModel();            
            return $model->updateEmployee($params);
        }
        catch (\Excetion $ex){
            return $this->handleExceptionOfAngular($ex);
        }
    }

    public function handleExceptionOfAngular($ex){
        return[
                'message' => $ex->getTraceAsString(),
                'error' => 1
            ];
    }

    public function actionGetDepartmentList(){
        try{
            Yii::$app->response->format = Response::FORMAT_JSON;
            return[
                'error' => 0,
                'result' => Department::find()->where(['DepartmentStatus' => 1])->all()
            ];
        }catch(\Excetion $ex){
            return $this->handleExceptionOfAngular($ex);
        }
    }

    public function actionSaveSection(){
        try{
            Yii::$app->response->format = Response::FORMAT_JSON;
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            $isCreate = ($params['sectionID'] === '') ? true : false;
            $section = $isCreate ? new Section() : Section::findOne($params['sectionID']);
            $section->sectionName = $params['sectionName'];

            if ($isCreate ? $section->save() : $section->update()  )
                return [
                    'error' => 0
                ];
            else return [
                    'error' => 1,
                    'message' => Untils::complexArrayToString($section->getErrors())
                ];
            
        }
        catch(\Excetion $ex){
            return $this->handleExceptionOfAngular($ex);
        }
    }

    public function actionGetLogList(){
        try{
            Yii::$app->response->format = Response::FORMAT_JSON;
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'error' => 0,
                'result' => LogModel::find()->where(['employeeCode' => $params['employeeCode']])->all()
            ];
        }
        catch(\Excetion $ex){
            return $this->handleExceptionOfAngular($ex);
        }
    }

}
?>
