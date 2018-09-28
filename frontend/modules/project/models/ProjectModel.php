<?php
namespace app\modules\project\models;

use yii\base\Model;
use common\models\Project;
use common\models\ProjectGroup;
use common\models\ProjectSaleplan;
use common\models\SpendTimeActual;
use common\models\SpendTimePlan;

class ProjectModel extends Model {    
    private $updateBy;
    
    public function __construct($updateBy, $config = array()) {
        $this->updateBy = $updateBy;
        parent::__construct($config);
    }

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
        $model->updateBy = $this->updateBy;
        if ($params['enabled'] !== NULL && $params['enabled'] !== '') {
            $model->enabled = $params['enabled']; 
        }
        return $model;
    }
    
    private function checkVaild($params) {
        $messError = '';
        if($params['groupId'] != null && $params['groupId'] != '' && ProjectGroup::findOne(['groupId' => $params['groupId']]) === null) {
            $messError .= 'This <b>Project Group</b> is not existence <br>';
        }        
        return $messError;
    }

    public function insProject($params) {
        if(($project = Project::findOne(['projectName' => $params['projectName'], 'projectCode' => $params['projectCode'], 'enabled' => 0])) != null) {
            $params['projectID'] = $project->projectID;
            $params['enabled'] = 1;
            return $this->updProjectBy($params);
        }        
        
        $messError = $this->checkVaild($params);
        if($messError != '') {
            throw new \Exception($messError);
        }
        
        try {
            $project = $this->mergeData(new Project(), $params);  
            return $project->save();
        } catch (\yii\db\Exception $exc) {
            switch ($exc->getCode()) {
                case 23000:  
                    $messError = $exc->getMessage(); //'<b>Project Name - Project Code</b> are existence';
                    break;
            }
            throw new \Exception($messError);
        }
    }
    
    public function updProjectBy($params) {        
        $messError = $this->checkVaild($params);
        if($messError != '') {
            throw new \Exception($messError);
        }
        
        try {
            $project = $this->mergeData(Project::findOne($params['projectID']), $params);          
            return $project->save();
        } catch (\yii\db\Exception $exc) {
            switch ($exc->getCode()) {
                case 23000:  
                    $messError = $exc->getMessage(); //'<b>Project Name - Project Code</b> are existence';
                    break;
            }
            throw new \Exception($messError);
        }
    }
    
    public function delProjectBy($params) {
        if(ProjectSaleplan::findOne(['projectID' => $params['projectID']]) != null) {
            throw new \Exception('This <b>Project</b> is used in project sale plan');
        } else if (SpendTimeActual::findOne(['projectID' => $params['projectID']]) != null) {
            throw new \Exception('This <b>Project</b> is used in spend time actual');
        } else if (SpendTimePlan::findOne(['projectID' => $params['projectID']]) != null) {
            throw new \Exception('This <b>Project</b> is used in spend time plan');
        }     
        $project = $this->mergeData(Project::findOne($params['projectID']), $params);  
        return $project->save();
    }
    
    public function getProjectBy($params) {
        $query = 'SELECT * '
               . 'FROM ' . Project::tableName() . ' '
               . 'WHERE projectName LIKE \'%'.$params['projectName'].'%\''
               . '  AND projectCode LIKE \'%'.$params['projectCode'].'%\''
               //. '  AND OTStatus = '.$params['OTStatus']
               . (($params['projectStatus'] != null && $params['projectStatus'] != '')
               ? '  AND projectStatus = '.$params['projectStatus'] : '')
               . (($params['endDate'] != null && $params['endDate'] != '')
               ? '  AND DATE_FORMAT(endDate, \'%Y/%m/%d\') = DATE_FORMAT(\''.$params['endDate'].'\', \'%Y/%m/%d\')' : '')
               . '  AND redmineURL LIKE \'%'.$params['redmineURL'].'%\''
               . '  AND redmineID LIKE \'%'.$params['redmineID'].'%\''
               . '  AND ivisID LIKE \'%'.$params['ivisID'].'%\''
               . '  AND sdcCode LIKE \'%'.$params['sdcCode'].'%\''
               . (($params['groupId'] != null && $params['groupId'] != '')
               ? '  AND groupId = '.$params['groupId'] : '')
               . '  AND enabled = 1'
               . ' ORDER BY groupId, projectName ASC'
               ;
        return Project::findBySql($query)
                ->all();
    }
    
    public function getLogs($params) {
        $query = 'SELECT ID, projectID, projectName, projectCode, OTStatus, projectStatus, endDate, redmineURL, redmineID, ivisID, sdcCode, groupId, updateTime, action, note, '
               . 'CASE '
               . '    WHEN updateBy IS NOT NULL THEN (SELECT CONCAT(em.employeeCode, \' - \', em.employeeName) FROM employee em WHERE em.employeeID = updateBy) '
               . '    ELSE \'\' '
               . 'END AS \'updateBy\' ' 
               . 'FROM ' . substr(Project::tableName(), 0, -3) . 'l}} '
               . 'WHERE projectID = '.$params['projectID'] 
               . ' ORDER BY updateTime DESC'
               ;
        return \Yii::$app->db->createCommand($query)->queryAll();
    }
}
