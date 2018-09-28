<?php
namespace app\modules\employee\models;

use yii\base\Model;
use common\models\Employee;            
use app\modules\employee\models\LogModel;
use yii;
use common\Untils;
class EmployeeModel extends Employee
{
	public function mergeData($params){
      $this->employeeName = $params['employeeName'];
      $this->employeeCode = $params['employeeCode'];
      $this->sectionID = $params['sectionId'];
      $this->levelID = $params['levelId'];
      $this->rank =$params['rankId'] ;
      $this->employeeStatus = $params['status'];
      $this->supervisorID = $this->checkK($params['supervisorId'])  ;
      $this->DoB = $params['birthDate'];
      $this->startDate = $params['startDate'];
      $this->endDate = $params['endDate'];
      $this->telephone = $params['telephone'];
      $this->mobile = $params['mobile'];
      $this->email = $params['email'];
      $this->maritalStatus = $params['maritalStatus'];
      $this->registeredAddress = $params['registedAddress'];
      $this->currentAddress = $params['currentAddress'];
      //$acc = Yii::$app->user->identity;
      //$this->updateBy = $acc->employeeId ;
      $this->isAdmin = $params['isAdmin'];
      $this->username = $this->checkA($params['username']) ? $params['username'] : null;
      $this->setPassword($params['password']);
      //$this->lastUpdate = $params['updateTime'];
     // $this->action = $params['action'];
    }
	public function rules()
    {
        return [
            [['employeeCode','employeeName'], 'required'],
            ['email','email'],
            ['employeeCode','unique'],
            ['mobile','number']
        ];
    }

    public function checkK($x){
      return $this->checkA($x) ?  $x : ' ';
    }

    public function checkA($x){
    	return (isset($x) && $x != '' ) ;
    }

	public function getEmployeeListBy($params){
        return self::find()->filterWhere(['AND',
        	['LIKE','employeeName',$params['employeeName']],
        	['LIKE','employeeCode',$params['employeeCode']],
        	['LIKE','sectionID',$params['sectionId']],
        	['LIKE','levelID', $params['levelId']],
        	['LIKE','rank',$params['rankId']],
        	['LIKE','mobile',$params['mobile']],
        	["DATE_FORMAT(DoB, '%Y/%m/%d')" => $params['birthDate']],
        	["DATE_FORMAT(startDate, '%Y/%m/%d')" => $params['startDate']],
        	["DATE_FORMAT(endDate, '%Y/%m/%d')" => $params['endDate']],
        	['LIKE','supervisorID',$params['supervisorId']],
        	['LIKE','telephone',$params['telephone']],
        	['LIKE','email',$params['email']],
        	['LIKE','registeredAddress',$params['registedAddress']],
        	['LIKE','currentAddress',$params['currentAddress']],
        	['maritalStatus' => $params['maritalStatus']],
        	['employeeStatus' => 1]])->all();
	} 

	public function createEmployee($params){

		$this->mergeData($params);
		if ($this->validate())
    {
			return [
				'error' => $this->save() ? 0 : 1,
				'message' => "You can not create any thing"
			];
    }
		else 
			return [
				'error' => 1,
				'message' => Untils::complexArrayToString($this->getErrors())
			];

	}

	public function updateEmployee($params){

		$employee = EmployeeModel::findOne($params['employeeId']);

		$employee->mergeData($params);

		if ($employee->validate()){
    
      return [
        'error' => $employee->update() ? 0 : 1,
        'message' => "You have not create any thing"
      ];
    }
		else 
		{
			return [
				'error' => 1,
				'message' => Untils::complexArrayToString($employee->getErrors())
			];
		}
	}
}
?>