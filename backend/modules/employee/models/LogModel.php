<?php
namespace app\modules\employee\models;

use yii\base\Model;
use common\models\EmployeeLog;
use common\models\Section;
use common\models\Level;
use common\models\Rank;
use common\Untils;
use yii;
class LogModel extends EmployeeLog
{
	public function mergeData($params){
	  $this->employeeName = $params['employeeName'];
      $this->employeeCode = $params['employeeCode'];
      $this->section = Section::findOne($params['sectionId'])->sectionName;
      $this->level = Level::findOne($params['levelId'])->levelName;
      $this->rank = Rank::findOne($params['rankId'])->rankName ;
      $this->status = $params['status'];
      $this->supervisorID = $params['supervisorId'];
      $this->DoB = $params['birthDate'];
      $this->startDate = $params['startDate'];
      $this->endDate = $params['endDate'];
      $this->telephone = $params['telephone'];
      $this->mobile = $params['mobile'];
      $this->email = $params['email'];
      $this->maritalStatus = $params['maritalStatus'];
      $this->registeredAddress = $params['registedAddress'];
      $this->currentAddress = $params['currentAddress'];
      $acc = Yii::$app->user->identity;
      $this->updateBy = $acc->username + $acc->employeeId ;
      $this->updateTime = $params['updateTime'];
      $this->action = $params['action'];
	}


}
?>
