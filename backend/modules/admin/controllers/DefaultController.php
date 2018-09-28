<?php
namespace app\modules\admin\controllers;

use app\controllers\BackendController;
use app\modules\admin\models\Form;
use app\modules\admin\models\powerLogModel;
use common\models\Privilege;
use common\models\Employee;
use common\models\Power;
use yii;
use yii\web\Response;
use common\models\PowerLog;
use common\Untils;
use app\modules\admin\models\powerModel;
class DefaultController extends BackendController {
	public function actionIndex(){
		$this->checkAdminLogin();
		return $this->render('index');
	}
	public function actionUpdatePower(){
		Yii::$app->response->format = Response::FORMAT_JSON;        
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
			$listId = $params['listAccountId'];
	    	$priId = $params['privilegeId'];
	    	$powCode = $params['powerCode'];

	    	foreach ($listId as $employeeId) {
	    		$power = Power::findOne(['accountId' => $employeeId,'privilegeId' => $priId]);
		    	if (!isset($power)){
		    		if ($powCode != 'n'){
			    		$power1 = new Power();
			    		$power1->setAttri($employeeId,$priId,$powCode);
			    		$power1->save();
		    		}
		    	}
		    	else {
		    		if ($powCode === 'n')
		    			$power->delete();
		    		else{
				    	$power->setAttri($employeeId,$priId,$powCode);
			    		$power->update();
		    		}
		    	}
		    }
		    return [
		    	'error' => 0
		    ];
		}
		catch( \Exception $ex){
			return [
				'error' => 1,
				'message' => $ex->getTraceAsString()
			];
		}
	}

    public function actionGetAccountList(){
    	Yii::$app->response->format = Response::FORMAT_JSON;
    	try{
    		return[
    			'result' =>Employee::find()->filterWhere(['AND',['isAdmin' => 0],['employeeStatus' => 1],['NOT','username',null]])->all(),
    			'error' => 0
    		];
    	}
    	catch(\Exception $ex){
    		return[
    			'message' => $ex->getTraceAsString(),
    			'error' => 1
    		];
    	}
    }
    public function actionGetPrivilegeList(){
    	Yii::$app->response->format = Response::FORMAT_JSON;
    	try{
    		return[
    			'result' => Privilege::find()->all(),
    			'error' => 0
    		];
    	}
    	catch(\Exception $ex){
    		return[
    			'message' => $ex->getTraceAsString(),
    			'error' => 1
    		];
    	}
    }
    public function actionGetPowerList(){
    	Yii::$app->response->format = Response::FORMAT_JSON;
    	try{
    		return[
    			'result' => powerModel::getList(),
    			'error' => 0
    		];
    	}
    	catch(\Exception $ex){
    		return[
    			'message' => $ex->getTraceAsString(),
    			'error' => 1
    		];
    	}
    }

    public function actionGetLog(){
        try{

            Yii::$app->response->format = Response::FORMAT_JSON;
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return[
                'error' => 0,
                'result' => powerLogModel::getLogListBy($params)
            ];
        }
        catch(\Exception $ex){
            return Untils::handleExceptionOfAngular($ex);
        }
    }
}
