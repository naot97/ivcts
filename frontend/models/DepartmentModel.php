<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Department;

class DepartmentModel extends Model {
    
    public function mergeData($model, $params) {
        $model->departmentID = $params['departmentID'];
        $model->departmentName = $params['departmentName'];
        $model->departmentStatus = $params['departmentStatus'];
        $model->displayOrder = $params['displayOrder'];
        return $model;
    }
    
    public function getAll() {
        return Department::find()
                ->select(['departmentID', 'departmentName'])
                ->where(['departmentStatus' => 1])
                ->orderBy(['displayOrder' => SORT_ASC])
                ->all();
    }
}
