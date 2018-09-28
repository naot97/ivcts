<?php
namespace app\modules\report\models;

use yii\base\Model;
use common\models\ProjectGroup;
use common\models\Project;
use common\models\ProjectSaleplan;
use common\models\SpendTimePlan;

class ReportModel extends Model {
    
    public function exportReport($params) {
        $groupBy = '';
        if($params['GroupBy'] === '1') {
            $groupBy = 'typeID';
        } else {
            $groupBy = 'rankID';
        }
        $queryGroupProject = '';
        if($params['groupID'] === '-1') {
            $queryGroupProject = '(SELECT \'\' AS \'groupID\', projectID '
                               . ' FROM ' . Project::tableName() . ' '
                               . ' WHERE enabled = 1 '
                               . '   AND groupId IS NULL) '
                               . 'UNION '
                               . '(SELECT pg.groupID, pr.projectID '
                               . ' FROM ' . Project::tableName() . ' pr INNER JOIN ' . ProjectGroup::tableName() . ' pg '
                               . '   ON pr.groupId = pg.groupID '
                               . ' WHERE pr.enabled = 1) ';
        } else if($params['groupID'] === '' || $params['groupID'] === null) {
            $queryGroupProject = '(SELECT \'\' AS \'groupID\', projectID '
                               . ' FROM ' . Project::tableName() . ' '
                               . ' WHERE enabled = 1 '
                               . '   AND groupId IS NULL) ';
        } else {
            $queryGroupProject = '(SELECT pg.groupID, pr.projectID '
                               . ' FROM ' . Project::tableName() . ' pr INNER JOIN ' . ProjectGroup::tableName() . ' pg '
                               . '   ON pr.groupId = pg.groupID '
                               . ' WHERE pr.enabled = 1 '
                               . '   AND pg.groupID = ' . $params['groupID'] . ') ';
        }
        
        $query = 'SELECT pg.groupID, pg.projectID, rpt.typeID, rpt.rankID, rpt.effort, rpt.position '
               . 'FROM ( '
               . '(SELECT projectID, typeID, rankID, SUM(effort) AS \'effort\', position '
               . ' FROM ' . ProjectSaleplan::tableName() . ' '
               . ' WHERE enabled = 1 '
               . '   AND periodID = ' . $params['periodID'] . ' '
               . ' GROUP BY projectID, position, ' . $groupBy . ') '
               . 'UNION '
               . '(SELECT projectID, typeID, rankID, SUM(effort) AS \'effort\', \'EMP\' AS \'position\' '
               . ' FROM ' . SpendTimePlan::tableName() . ' '
               . ' WHERE enabled = 1 '
               . '   AND periodID = ' . $params['periodID'] . ' '
               . ' GROUP BY projectID, ' . $groupBy . ')) rpt '
               . 'INNER JOIN (' . $queryGroupProject . ') pg '
               . '  ON rpt.projectID = pg.projectID '
               . 'ORDER BY pg.groupID, pg.projectID, rpt.position, rpt.typeID, rpt.rankID ASC ';
        try {
            return \Yii::$app->db->createCommand($query)->queryAll();
        } catch (\yii\db\Exception $exc) {
            throw new \Exception($exc->getMessage());
        }
    }
}
