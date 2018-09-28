<?php
namespace app\modules\report\models;

use yii\base\Model;
use common\models\ProjectGroup;
use common\models\Project;
use common\models\ProjectSaleplan;
use common\models\SpendTimePlan;
use yii;
class effortModel extends Model {
    public static function listToStringQuery($list){
        $str = '(';
        $first = true;
        foreach ($list as $element) {
            if ($first === true)
            {
                $str .= $element;
                $first = false;
            }
            else $str .= ','.$element;
        }
        $str .= ')';
        return $str;
    }
    public static function getListByLevel($params) {
    	$strListRank = self::listToStringQuery($params['rankListSelected']);
        /*$query = '
	        	SELECT l.levelID,count(employeeID) as employees,levelName FROM 
	        		(SELECT pl.effort, e.employeeID,e.levelID 
	        			FROM (SELECT employeeID,sum(effort) as effort 
	        				FROM spend_time_plan_r WHERE periodID = ' . $params['periodID'].' AND rankID IN ' .$strListRank.' GROUP BY employeeID ) pl 
	        			INNER JOIN employee e ON pl.employeeID = e.employeeID WHERE effort BETWEEN '.$params['to'].' AND '.$params['from'].' ) p_e 
	        	RIGHT JOIN level l ON p_e.levelID = l.levelID 
	        	GROUP BY levelID';*/
        $query =     'SELECT * FROM (
        SELECT employeeID,sum(effort) as effort FROM spend_time_plan_r WHERE periodID = '. $params['periodID'].' AND rankID IN '.$strListRank.' GROUP BY employeeID ) pl INNER JOIN employee e ON pl.employeeID = e.employeeID WHERE effort BETWEEN ' . $params['from'].' AND '.$params['to'];
        
	    return Yii::$app->db->createCommand($query)->queryAll();
    }

    public static function getDetailList($params){
        $query = 'SELECT * FROM (employee  INNER JOIN spend_time_plan_r ON employee.employeeID = spend_time_plan_r.employeeID ) INNER JOIN project_r ON
            spend_time_plan_r.projectID = project_r.projectID
            WHERE employee.employeeID in '. self::listToStringQuery($params['employeeIDList']).
            ' AND periodID = '. $params['periodID'] . ' AND rankID IN ' .self::listToStringQuery($params['rankListSelected']);

        return Yii::$app->db->createCommand($query)->queryAll();
    }
}

