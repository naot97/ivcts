<?php
namespace app\modules\report\models;

use yii\base\Model;
use common\models\ProjectGroup;
use common\models\Project;
use common\models\ProjectSaleplan;
use common\models\SpendTimePlan;
use common\Untils;
use yii;
class periodModel extends Model {
    public static function getSpendTimePlanBy($params) {
        $query = 'SELECT * '
               . 'FROM ' . SpendTimePlan::tableName() . ' '
               . 'WHERE enabled = 1'
               . (($params['sectionID'] != null && $params['sectionID'] != '')
               ? '  AND sectionID = '.$params['sectionID'] : '')
               . (($params['employeeID'] != null && $params['employeeID'] != '')
               ? '  AND employeeID = '.$params['employeeID'] : '')
               . (($params['projectID'] != null && $params['projectID'] != '')
               ? '  AND projectID = '.$params['projectID'] : '')
               . (($params['periodID'] != null && $params['periodID'] != '')
               ? '  AND periodID = '.$params['periodID'] : '')
               . (($params['rankID'] != null && $params['rankID'] != '')
               ? '  AND rankID IN '.Untils::listToStringQuery($params['rankID']) : '')
               . (($params['typeID'] != null && $params['typeID'] != '')
               ? '  AND typeID = '.$params['typeID'] : '')
               . (($params['effort'] != null && $params['effort'] != '')
               ? '  AND effort = '.$params['effort'] : '')
               . (($params['ot'] != null && $params['ot'] != '')
               ? '  AND ot = '.$params['ot'] : '')
               . ' ORDER BY sectionID,employeeID,projectID, periodID, rankID, typeID ASC'
               ;
        return SpendTimePlan::findBySql($query)
                ->all();
    }

    public static function getProjectOfSpendTimeBy($params){
    /*  $query = 'SELECT project_r.*,COUNT(spend_time_plan_r.projectID) from spend_time_plan_r right join project_r on spend_time_plan_r.projectID = project_r.projectID '.(($params['periodID'] != null && $params['periodID'] != '') ?
          ' where periodID = ' . $params['periodID'] : ' ').
          (($params['projectID'] != null && $params['projectID'] != '') ?
          ' and spend_time_plan_r.projectID = ' . $params['projectID'] : ' ').
          (($params['sectionID'] != null && $params['sectionID'] != '') ?
          ' and spend_time_plan_r.sectionID = ' . $params['sectionID'] : ' '). ' GROUP BY projectID ORDER BY projectID' ;*/
    if ($params['projectID'] != null && $params['projectID'] != '')
    $query = 'SELECT p.* from( select * from spend_time_plan_r '
          .(($params['periodID'] != null && $params['periodID'] != '') ?
          ' where periodID = ' . $params['periodID'] : ' ')
          .(($params['sectionID'] != null && $params['sectionID'] != '') ?
          ' and sectionID = '. $params['sectionID'] : ' '). ' ) sT RIGHT join project_r p on sT.projectID = p.projectID GROUP by projectID '
           . (($params['projectID'] != null && $params['projectID'] != '') ?
           ' having p.projectID = ' . $params['projectID'] : ' ');
      else 
         $query = 'SELECT project_r.*,COUNT(spend_time_plan_r.projectID) from spend_time_plan_r right join project_r on spend_time_plan_r.projectID = project_r.projectID '.(($params['periodID'] != null && $params['periodID'] != '') ?
          ' where periodID = ' . $params['periodID'] : ' ').
          (($params['projectID'] != null && $params['projectID'] != '') ?
          ' and spend_time_plan_r.projectID = ' . $params['projectID'] : ' ').
          (($params['sectionID'] != null && $params['sectionID'] != '') ?
          ' and spend_time_plan_r.sectionID = ' . $params['sectionID'] : ' '). ' GROUP BY projectID ORDER BY projectID' ;
      return Yii::$app->db->createCommand($query)->queryAll();
    }

    public static function getSectionOfSpendTimeBy($params){
      if ($params['sectionID'] != null && $params['sectionID'] != '')
        $query = 'SELECT s.* from( select * from spend_time_plan_r '
          .(($params['periodID'] != null && $params['periodID'] != '') ?
          ' where periodID = ' . $params['periodID'] : ' ')
          .(($params['projectID'] != null && $params['projectID'] != '') ?
          ' and projectID = '. $params['projectID'] : ' '). ' ) sT RIGHT join section s on sT.sectionID = s.sectionID GROUP by sectionID '
           . (($params['sectionID'] != null && $params['sectionID'] != '') ?
           ' having s.sectionID = ' . $params['sectionID'] : ' ');
      else
       $query = 'SELECT section.* from spend_time_plan_r right join section on spend_time_plan_r.sectionID = section.sectionID '.
        (($params['periodID'] != null && $params['periodID'] != '') ?
          ' where periodID = ' . $params['periodID'] : ' ').
          (($params['sectionID'] != null && $params['sectionID'] != '') ?
          ' and spend_time_plan_r.sectionID = ' . $params['sectionID'] : ' ')
          .
          (($params['projectID'] != null && $params['projectID'] != '') ?
          ' and spend_time_plan_r.projectID = ' . $params['projectID'] : ' ')
         .' GROUP BY sectionID ORDER BY sectionID' ;

      

      return Yii::$app->db->createCommand($query)->queryAll();
    }
}


