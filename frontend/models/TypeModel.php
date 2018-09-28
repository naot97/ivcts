<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Type;

class TypeModel extends Model {
    
    public function mergeData($model, $params) {
        $model->typeID = $params['typeID'];
        $model->typeName = $params['typeName'];
        $model->typeStatus = $params['typeStatus'];
        $model->displayOrder = $params['displayOrder'];
        return $model;
    }
    
    public function getAll() {
        return Type::find()
                ->select(['typeID', 'typeName'])
                ->where(['typeStatus' => 1])
                ->orderBy(['displayOrder' => SORT_ASC])
                ->all();
    }
}
