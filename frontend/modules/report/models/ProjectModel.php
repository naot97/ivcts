<?php
namespace app\modules\report\models;

use yii\base\Model;
use common\models\ProjectSaleplan;
use common\models\SpendTimePlan;
use common\models\SpendTimeActual;
use yii;
use common\Untils;
class ProjectModel extends Model {
	public static function isNotNullOrEmpty($p){
		return ($p != null && $p != '');
	}
	public static function queryProject($tbName,$params,$extraWhere){
		return 'select sectionID,projectID,periodID,SUM(effort) as sumEffort from '.$tbName.' where periodID = ' .$params['periodID'] 
		.(self::isNotNullOrEmpty($params['sectionID'])? ' and sectionID = ' .$params['sectionID'] : '')
		.(self::isNotNullOrEmpty($params['projectID'])? ' and projectID = ' .$params['projectID'] : '')
		.(self::isNotNullOrEmpty($params['rankID'])? ' and rankID in ' .Untils::listToStringQuery($params['rankID']) : '')
		.$extraWhere
		.' group by sectionID,projectID';
	}

	/*public static function fullJoin($query1,$query2,$step){
        return 
        	'(SELECT '..' FROM ( '.$query1.' ) A LEFT JOIN ( '.$query2.' ) B
			  ON A.sectionID = B.sectionID and A.projectID = B.projectID
			) 
			UNION ALL
			(SELECT '..' FROM ( '.$query1.' ) A RIGHT JOIN ( '.$query2.' ) B
			 ON A.sectionID = B.sectionID and A.projectID = B.projectID 
			 where A.sectionID is null
			)';
    }

	public static function getQuerySale($tbName,$params){
		return 'select sectionID,projectID,periodID,SUM(case when position = \'SDC\' then effort else 0 end) as sumSaleSDC,SUM(case when position = \'PM\' then effort else 0 end) as sumSalePM from '.$tbName.' where periodID = ' .$params['periodID'] 
		.(self::checkParam($params['sectionID'])? ' and sectionID = ' .$params['sectionID'] : '')
		.(self::checkParam($params['projectID'])? ' and projectID = ' .$params['projectID'] : '')
		.(self::checkParam($params['rankID'])? ' and rankID in ' .Untils::listToStringQuery($params['rankID']) : '')
		.' group by sectionID,projectID';
	}*/


	public static function queryProjectAllSection($tbName,$params,$extraWhere){
		return 'select projectID,periodID,SUM(effort) as sumEffort from '.$tbName
		.' where periodID = ' .$params['periodID'] 
		.(self::isNotNullOrEmpty($params['projectID'])? ' and projectID = ' .$params['projectID'] : '')
		.(self::isNotNullOrEmpty($params['rankID'])? ' and rankID in ' .Untils::listToStringQuery($params['rankID']) : '')
		.$extraWhere
		.' group by projectID';
	}

	public static function getProjectAllSection($kind,$params){
		$tbName = '';
		$extraWhere = '';
		switch ($kind) {
			case 'SDC':
				$tbName = ProjectSaleplan::tableName();
				$extraWhere = ' and position = \'SDC\' '; 
				break;
			case 'PM' :
				$tbName = ProjectSaleplan::tableName();
				$extraWhere = ' and position = \'PM\' '; 
				break;
			case 'Plan':
				$tbName = SpendTimePlan::tableName();
				break;
			case 'Assignment':
				$tbName = SpendTimeActual::tableName();
				break;
			default:
				break;
		}
		$query = self::queryProjectAllSection($tbName,$params,$extraWhere);
		return Yii::$app->db->createCommand($query)->queryAll();
	}

	public static function getSaleSDC($params){
		$query = self::queryProject(ProjectSaleplan::tableName(),$params,' and position = \'SDC\' ');
		return Yii::$app->db->createCommand($query)->queryAll(); 
	}
	public static function getSalePM($params){
		$query= self::queryProject(ProjectSaleplan::tableName(),$params,' and position = \'PM\'');
		return Yii::$app->db->createCommand($query)->queryAll(); 
	}

	public static function getPlan($params){
		$query= self::queryProject(SpendTimePlan::tableName(),$params,'');
		return Yii::$app->db->createCommand($query)->queryAll(); 
	}

	public static function getAssignment($params){
		$query = self::queryProject(SpendTimeActual::tableName(),$params,'');
		return Yii::$app->db->createCommand($query)->queryAll(); 
	}	

   /* public static function getProjectReport($params){

    	$querySale = self::getQuerySale(ProjectSaleplan::tableName(),$params);
    	$querySTActual = self::queryTable(SpendTimeActual::tableName(),$params,'sumActual');
    	$querySTPlan = self::queryTable(SpendTimePlan::tableName(),$params,'sumPlan');

    	
    	$query = self::fullJoin($querySale,$querySTActual);
    	$query = self::fullJoin($query,$querySTPlan);
    	return Yii::$app->db->createCommand($query)->queryAll(); 
    }

    public static function getProjectReportAllSection($params){


    }*/
}
?>

