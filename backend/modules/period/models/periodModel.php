<?php
namespace app\modules\period\models;

use Yii;
use common\models\Period;
use common\Untils;
class periodModel extends Period{
	public $errorMess = '';
	public static function getListBy($params){
		return Period::find()->filterWhere(
		[	'AND',
			['LIKE','month',$params['month']],
			['LIKE','year',$params['year']],
			['LIKE','workingHour',$params['workingHour']],
			['periodStatus' => 1]
		])->all();
	}
	public function checkUniqueMonthYear(){
		if (periodModel::findOne(['month' => $this->month,'year' => $this->year]) != null)
		{
			$this->addError('month','Month and Year have been existed');
			return false;
		}
		return true;
	}
	public function mergeData($params){
		$this->month = $params['month'];
		$this->year = $params['year'];
		$this->workingHour = $params['workingHour'];
	}
	
	public function savePeriod($params){

		$isNew = $params['periodID'] == '' ? true : false ;
		$period = $isNew ? new periodModel() : periodModel::findOne($params['periodID']);
		$period->mergeData($params);
		if ($isNew) 
			if (!$period->checkUniqueMonthYear()) {
				$this->errorMess = Untils::complexArrayToString($period->errors);
				return false;
			}
		$result = $isNew ? $period->save() : $period->update();
		$this->errorMess = Untils::complexArrayToString($period->errors);
		return $result; 

	}
}
?>

