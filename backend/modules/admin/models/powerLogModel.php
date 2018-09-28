<?php
namespace app\modules\admin\models;

use common\models\PowerLog;
use yii;
use yii\base\Model;	
use yii\helpers\Json;

class powerLogModel extends PowerLog
{	
	public static function getLogListBy($params){
    	$list = PowerLog::find()->where(['employeeID' => $params['employeeID']])->all();
    	
    	foreach ($list as $log){ 
    		if (isset($log->value))
    		{
    			if ($log->validateCodePower('wr'))
    				$log->value = 'Read-Write';
    			else $log->value ='Read';
    		}
    		else $log->value ='None';
    	}
    	return $list;
    }
	
}
?>


