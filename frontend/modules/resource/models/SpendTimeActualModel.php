<?php
namespace app\modules\resource\models;

use yii\base\Model;
use common\models\SpendTimeActual;
use common\models\Section;
use common\models\Employee;
use common\models\Project;
use common\models\Period;
use common\models\Rank;
use common\models\Type;

class SpendTimeActualModel extends Model {
    private $updateBy;
    
    public function __construct($updateBy, $config = array()) {
        $this->updateBy = $updateBy;
        parent::__construct($config);
    }
    
    public function mergeData($model, $params) {
        $model->spendTimeID = $params['spendTimeID'];
        $model->sectionID = $params['sectionID'];
        $model->employeeID = $params['employeeID'];
        $model->projectID = $params['projectID'];
        $model->periodID = $params['periodID'];
        $model->rankID = $params['rankID'];
        $model->typeID = $params['typeID'];
        $model->effort = $params['effort'];
        if ($params['ot'] !== NULL && $params['ot'] !== '') {
            $model->ot = $params['ot']; 
        }
        $model->updateBy = $this->updateBy;
        if ($params['enabled'] !== NULL && $params['enabled'] !== '') {
            $model->enabled = $params['enabled']; 
        }
        return $model;
    }
    
    private function checkValid($params) {        
        $messError = '';
        if($params['sectionID'] != null && $params['sectionID'] != '' && Section::findOne(['sectionID' => $params['sectionID']]) === null) {
            $messError .= 'This <b>Section</b> is not existence <br>';
        }       
        if($params['employeeID'] != null && $params['employeeID'] != '' && Employee::findOne(['employeeID' => $params['employeeID']]) === null) {
            $messError .= 'This <b>Employee</b> is not existence <br>';
        }       
        if($params['projectID'] != null && $params['projectID'] != '' && Project::findOne(['projectID' => $params['projectID']]) === null) {
            $messError .= 'This <b>Project</b> is not existence <br>';
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
    
    public function insSpendTimeActual($params) {
        if(($spendTimeActual = SpendTimeActual::findOne(['sectionID' => $params['sectionID'], 
                                                         'employeeID' => $params['employeeID'], 
                                                         'projectID' => $params['projectID'], 
                                                         'periodID' => $params['periodID'], 
                                                         'rankID' => $params['rankID'], 
                                                         'typeID' => $params['typeID'], 
                                                         'enabled' => 0])) != null) {
            $params['spendTimeID'] = $spendTimeActual->spendTimeID;
            $params['enabled'] = 1;
            return $this->updSpendTimeActual($params);
        }                
        
        $messError = $this->checkValid($params);
        if($messError != '') {
            throw new \Exception($messError);
        }
        
        try {
            $spendTimeActual = $this->mergeData(new SpendTimeActual(), $params);  
            return $spendTimeActual->save();
        } catch (\yii\db\Exception $exc) {
            switch ($exc->getCode()) {
                case 23000:  
                    $messError = $exc->getMessage(); //'<b>Section - Employee - Project - Period - Rank - Type</b> are existence';
                    break;
            }
            throw new \Exception($messError);
        }
    }    
    
    public function updSpendTimeActual($params) {
        $messError = $this->checkValid($params);
        if($messError != '') {
            throw new \Exception($messError);
        }
        
        try {
            $spendTimeActual = $this->mergeData(SpendTimeActual::findOne($params['spendTimeID']), $params);          
            return $spendTimeActual->save();
        } catch (\yii\db\Exception $exc) {
            switch ($exc->getCode()) {
                case 23000:  
                    $messError = $exc->getMessage(); //'<b>Section - Employee - Project - Period - Rank - Type</b> are existence';
                    break;
            }
            throw new \Exception($messError);
        }
    }
    
    public function delSpendTimeActual($params) {
        $spendTimeActual = $this->mergeData(SpendTimeActual::findOne($params['spendTimeID']), $params);  
        return $spendTimeActual->save();
    }
    
    public function getSpendTimeActualBy($params) {
        $query = 'SELECT * '
               . 'FROM ' . SpendTimeActual::tableName() . ' '
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
               ? '  AND rankID = '.$params['rankID'] : '')
               . (($params['typeID'] != null && $params['typeID'] != '')
               ? '  AND typeID = '.$params['typeID'] : '')
               . (($params['effort'] != null && $params['effort'] != '')
               ? '  AND effort = '.$params['effort'] : '')
               . (($params['ot'] != null && $params['ot'] != '')
               ? '  AND ot = '.$params['ot'] : '')
               . ' ORDER BY employeeID, sectionID, projectID, periodID, rankID, typeID ASC'
               ;
        return SpendTimeActual::findBySql($query)
                ->all();
    }
    
    public function getLogs($params) {
        $query = 'SELECT ID, spendTimeID, sectionID, employeeID, projectID, periodID, rankID, typeID, effort, ot, updateTime, action, note, '
               . 'CASE '
               . '    WHEN updateBy IS NOT NULL THEN (SELECT CONCAT(em.employeeCode, \' - \', em.employeeName) FROM employee em WHERE em.employeeID = updateBy) '
               . '    ELSE \'\' '
               . 'END AS \'updateBy\' ' 
               . 'FROM ' . substr(SpendTimeActual::tableName(), 0, -3) . 'l}} '
               . 'WHERE spendTimeID = '.$params['spendTimeID'] 
               . ' ORDER BY updateTime DESC'
               ;
        return \Yii::$app->db->createCommand($query)->queryAll();
    }
}
