<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Section;

class SectionModel extends Model {
    
    public function mergeData($model, $params) {
        $model->sectionID = $params['sectionID'];
        $model->sectionName = $params['sectionName'];
        $model->departmentID = $params['departmentID'];
        $model->sectionStatus = $params['sectionStatus'];
        $model->displayOrder = $params['displayOrder'];
        $model->headID = $params['headID'];
        return $model;
    }
    
    public function getAll() {
        return Section::find()
                ->select(['sectionID', 'sectionName', 'departmentID'])
                ->where(['sectionStatus' => 1])
                ->orderBy(['displayOrder' => SORT_ASC])
                ->all();
    }
}
