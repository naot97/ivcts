<?php
namespace app\modules\project\models;

use yii\base\Model;
use common\models\ProjectSaleplan;
use common\models\Project;
use common\models\Section;
use common\models\Period;
use common\models\Rank;
use common\models\Type;

class ProjectSalePlanModel extends Model {
    private $updateBy;
    private $position;
    
    public function __construct($updateBy, $config = array()) {
        $this->updateBy = $updateBy;
        parent::__construct($config);
    }
    
    public function setPosition($p) {
        $this->position = $p;
    }

    public function mergeData($model, $params) {
        $model->saleplanID = $params['saleplanID'];
        $model->projectID = $params['projectID'];
        $model->sectionID = $params['sectionID'];
        $model->periodID = $params['periodID'];
        $model->rankID = $params['rankID'];
        $model->typeID = $params['typeID'];
        $model->effort = $params['effort'];
        $model->position = $this->position;
        $model->updateBy = $this->updateBy;
        if ($params['enabled'] !== NULL && $params['enabled'] !== '') {
            $model->enabled = $params['enabled']; 
        }
        return $model;
    }
    
    private function checkValid($params) {        
        $messError = '';
        if($params['projectID'] != null && $params['projectID'] != '' && Project::findOne(['projectID' => $params['projectID']]) === null) {
            $messError .= 'This <b>Project</b> is not existence <br>';
        }        
        if($params['sectionID'] != null && $params['sectionID'] != '' && Section::findOne(['sectionID' => $params['sectionID']]) === null) {
            $messError .= 'This <b>Section</b> is not existence <br>';
        }        
        if($params['periodID'] != null && $params['periodID'] != '' && Period::findOne(['periodID' => $params['periodID']]) === null) {
            $messError .= 'This <b>Period</b> is not existence <br>';
        }        
        if($params['rankID'] != null && $params['rankID'] != '' && Rank::findOne(['rankID' => $params['rankID']]) === null) {
            $messError .= 'This <b>Rank</b> is not existence <br>';
        }        
        if($params['typeID'] != null && $params['typeID'] != '' && Type::findOne(['typeID' => $params['typeID']]) === null) {
            $messError .= 'This <b>Type</b> is not existence <br>';
        }        
        return $messError;
    }
    
    public function insProjectSaleplan($params) {
        if(($projectSalePlan = ProjectSaleplan::findOne(['projectID' => $params['projectID'], 
                                                         'rankID' => $params['rankID'], 
                                                         'typeID' => $params['typeID'], 
                                                         'position' => $this->position, 
                                                         'enabled' => 0])) != null) {
            $params['saleplanID'] = $projectSalePlan->saleplanID;
            $params['enabled'] = 1;
            return $this->updProjectSaleplan($params);
        }                
        
        $messError = $this->checkValid($params);
        if($messError != '') {
            throw new \Exception($messError);
        }
        
        try {
            $projectSalePlan = $this->mergeData(new ProjectSaleplan(), $params);  
            return $projectSalePlan->save();
        } catch (\yii\db\Exception $exc) {
            switch ($exc->getCode()) {
                case 23000:  
                    $messError = $exc->getMessage(); //'<b>Project - Rank - Type</b> are existence';
                    break;
            }
            throw new \Exception($messError);
        }
    }    
    
    public function updProjectSaleplan($params) {
        $messError = $this->checkValid($params);
        if($messError != '') {
            throw new \Exception($messError);
        }
        
        try {
            $projectSalePlan = $this->mergeData(ProjectSaleplan::findOne($params['saleplanID']), $params);          
            return $projectSalePlan->save();
        } catch (\yii\db\Exception $exc) {
            switch ($exc->getCode()) {
                case 23000:  
                    $messError = $exc->getMessage(); //'<b>Project - Rank - Type</b> are existence';
                    break;
            }
            throw new \Exception($messError);
        }
    }
    
    public function delProjectSaleplan($params) {
        $projectSalePlan = $this->mergeData(ProjectSaleplan::findOne($params['saleplanID']), $params);  
        return $projectSalePlan->save();
    }
    
    public function getProjectSaleplanBy($params) {
        $query = 'SELECT * '
               . 'FROM ' . ProjectSaleplan::tableName() . ' '
               . 'WHERE enabled = 1'
               . '  AND position = \'' . $this->position . '\' '
               . (($params['projectID'] != null && $params['projectID'] != '')
               ? '  AND projectID = '.$params['projectID'] : '')
               . (($params['sectionID'] != null && $params['sectionID'] != '')
               ? '  AND sectionID = '.$params['sectionID'] : '')
               . (($params['periodID'] != null && $params['periodID'] != '')
               ? '  AND periodID = '.$params['periodID'] : '')
               . (($params['rankID'] != null && $params['rankID'] != '')
               ? '  AND rankID = '.$params['rankID'] : '')
               . (($params['typeID'] != null && $params['typeID'] != '')
               ? '  AND typeID = '.$params['typeID'] : '')
               . (($params['effort'] != null && $params['effort'] != '')
               ? '  AND effort = '.$params['effort'] : '')
               . ' ORDER BY projectID, sectionID, periodID, rankID, typeID ASC'
               ;
        return ProjectSaleplan::findBySql($query)
                ->all();
    }
    
    public function getLogs($params) {
        $query = 'SELECT ID, saleplanID, projectID, sectionID, periodID, rankID, typeID, effort, updateTime, action, note, '
               . 'CASE '
               . '    WHEN updateBy IS NOT NULL THEN (SELECT CONCAT(em.employeeCode, \' - \', em.employeeName) FROM employee em WHERE em.employeeID = updateBy) '
               . '    ELSE \'\' '
               . 'END AS \'updateBy\' ' 
               . 'FROM ' . substr(ProjectSaleplan::tableName(), 0, -3) . 'l}} '
               . 'WHERE saleplanID = '.$params['saleplanID'] 
               . ' ORDER BY updateTime DESC'
               ;
        return \Yii::$app->db->createCommand($query)->queryAll();
    }
    
    public function copyNewDataPeriod($params) {
        $query = 'INSERT INTO ' . substr(ProjectSaleplan::tableName(), 0, -3) . 'r}} '
               . '(projectID, sectionID, periodID, rankID, typeID, effort, position, updateBy) '
               . 'SELECT projectID, sectionID, ' . $params['newPeriod'] . ', rankID, typeID, effort, position, ' . $this->updateBy . ' ' 
               . 'FROM ' . substr(ProjectSaleplan::tableName(), 0, -3) . 'r}} '
               . 'WHERE projectID = '.$params['project'] 
               . '  AND periodID = '.$params['oldPeriod'] 
               . '  AND position = \''.$this->position.'\''
               ;
        return \Yii::$app->db->createCommand($query)->execute();
    }
}
