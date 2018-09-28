<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Level;

class LevelModel extends Model {
    
    public function mergeData($model, $params) {
        $model->levelID = $params['levelID'];
        $model->levelName = $params['levelName'];
        $model->levelStatus = $params['levelStatus'];
        $model->displayOrder = $params['displayOrder'];
        $model->levelCode = $params['levelCode'];
        return $model;
    }
    
    public function getAll() {
        return Level::find()
                ->orderBy(['displayOrder' => SORT_ASC])
                ->all();
    }
}
