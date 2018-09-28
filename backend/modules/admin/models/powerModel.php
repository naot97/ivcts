<?php
namespace app\modules\admin\models;

use common\models\Power;
use yii;
use yii\base\Model;	
use yii\helpers\Json;

class powerModel extends Power
{	
	public $value=1;

	public static function getList(){
		$list = powerModel::find()->all();
		$arr = array();

		foreach ($list as $power) {
		//	$power->accountPower = $power->validateCodePower('wr') ? 'wr' : 'r';
			$arr[$power->accountId .'-'. $power->privilegeId] = $power->validateCodePower('wr') ? 'Read-Write' : 'Read';
		}
				//throw new Exception("Error Processing Request", 1);
		

		return $arr;
	}

	
}
?>
