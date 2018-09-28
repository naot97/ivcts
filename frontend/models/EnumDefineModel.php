<?php
namespace frontend\models;

use yii\base\Model;
use common\models\EnumDefine;

class EnumDefineModel extends Model {
    
    public function mergeData($model, $params) {
        $model->enumDefine = $params['enumDefine'];
        $model->tableName = $params['tableName'];
        $model->colName = $params['colName'];
        $model->value = $params['value'];
        $model->description = $params['description'];
        $model->displayOrder = $params['displayOrder'];
        $model->enabled = $params['enabled'];
        return $model;
    }
    
    public function getAll() {
        return EnumDefine::find()
                ->where(['enabled' => 1])
                ->orderBy(['displayOrder' => SORT_ASC])
                ->all();
    }
    
    public function getEnumDefineBy($tblName, $colName) {        
        return EnumDefine::find()
                ->select(['description', 'value'])
                ->where(['tableName' => $tblName,
                         'colName' => $colName,
                         'enabled' => 1])
                ->orderBy([
                    'tableName' => SORT_ASC,
                    'colName' => SORT_ASC,
                    'displayOrder' => SORT_ASC,
                    ])
                ->all();
    }
}
