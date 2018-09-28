<?php
namespace app\controllers;

use yii\web\Controller;
use common\models\Power;
use common\models\Employee;
use common\models\Privilege;

use yii\base\Exception;
use yii;
class MyController extends Controller{
    public $functionId;
	/*public function behaviors(){
    	return [
    		'access' => [
    			'class' => \yii\filters\AccessControl::className(),
    			'only' => ['index'],
    			'rules' => [
    				[
    					'allow' => true,
    					'roles' => ['@'],
    				],
    			],
    		],
    	];
    }*/
    public function check(){
        //
        if (!isset(Yii::$app->user->identity)) {
            Yii::$app->response->redirect(Yii::$app->request->baseUrl."/login");
            return;
        }
        //
        $employeeID =  Yii::$app->user->identity->__get('employeeID');
        if (Employee::findOne($employeeID)->isAdmin) return true;
        if (!isset($this->functionId)) {
            Yii::$app->response->redirect(Yii::$app->request->baseUrl."/dashboard");
            return;
        }
        //
        $privilegeId = Privilege::findOne(['functionId' => $this->functionId])->privilegeId;
        $p = Power::findOne(['accountId' => $employeeID, 'privilegeId' =>$privilegeId]);
        if (!isset($p)){
            Yii::$app->response->redirect(Yii::$app->request->baseUrl."/dashboard");
            return;
        }
        else
        return $p->validateCodePower('wr');       // co quyen wr hoac r 
    }
}  
?>
