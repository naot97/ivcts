<?php
namespace app\modules\project\models;

use yii\base\Model;
use common\models\ProjectGroup;
use common\models\Project;

class ProjectGroupModel extends Model {
    
    public function mergeData($model, $params) {
        $model->groupID = $params['groupID'];
        $model->groupNAme = $params['groupNAme'];
        return $model;
    }
    
    public function insProjectGroup($params) {
        $projectGroup = $this->mergeData(new ProjectGroup(), $params);  
        return $projectGroup->save();
    }    
    
    public function updProjectGroupBy($params) {
        $projectGroup = $this->mergeData(ProjectGroup::findOne($params['groupID']), $params);       
        return $projectGroup->save();
    }
    
    public function delProjectGroupBy($params) {
        if(Project::findOne(['groupId' => $params['groupID']]) != null) {
            throw new \Exception('This project group is used');
        }
        return ProjectGroup::deleteAll(['groupID' => $params['groupID']]) > 0;
    }
}
