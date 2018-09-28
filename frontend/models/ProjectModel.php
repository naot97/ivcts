<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Project;
use common\models\ProjectGroup;

class ProjectModel extends Model {    
    
    public function mergeData($model, $params) {
        $model->projectID = $params['projectID'];
        $model->projectName = $params['projectName'];
        $model->projectCode = $params['projectCode'];
        $model->OTStatus = $params['OTStatus'];
        $model->projectStatus = $params['projectStatus'];
        $model->endDate = $params['endDate'] === NULL || $params['endDate'] === '' ? NULL : $params['endDate'];
        $model->redmineURL = $params['redmineURL'];
        $model->redmineID = $params['redmineID'];
        $model->ivisID = $params['ivisID'];
        $model->sdcCode = $params['sdcCode'];
        $model->groupId = $params['groupId'];
        return $model;
    }
    
    public function getProjects() {
        $query = '(SELECT \'\' AS \'groupID\', \'-------------\' AS \'groupNAme\', projectID, CONCAT(projectCode, \' - \', projectName) AS \'projectName\' '
               . 'FROM ' . Project::tableName() . ' '
               . 'WHERE enabled = 1 '
               . '  AND groupId IS NULL ' 
               . 'ORDER BY projectCode ASC) '
               . 'UNION ' 
               . '(SELECT pg.groupID, pg.groupNAme, pr.projectID, CONCAT(pr.projectCode, \' - \', pr.projectName) AS \'projectName\' '
               . 'FROM ' . Project::tableName() . ' pr INNER JOIN ' . ProjectGroup::tableName() . ' pg '
               . '  ON pr.groupId = pg.groupID '
               . 'WHERE pr.enabled = 1 '
               . 'GROUP BY pr.groupId, pr.projectID '
               . 'ORDER BY pg.groupID, pr.projectCode ASC) '
               ;
        return \Yii::$app->db->createCommand($query)->queryAll();
    }
}
