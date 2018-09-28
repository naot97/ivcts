<?php
namespace frontend\models;

use yii\base\Model;
use common\models\ProjectGroup;

class ProjectGroupModel extends Model {
    
    public function mergeData($model, $params) {
        $model->groupID = $params['groupID'];
        $model->groupNAme = $params['groupNAme'];
        return $model;
    }
    
    public function getAll() {
        return ProjectGroup::find()
                ->orderBy(['groupNAme' => SORT_ASC])
                ->all();
    }
}
