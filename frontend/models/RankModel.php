<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Rank;

class RankModel extends Model {
    
    public function mergeData($model, $params) {
        $model->rankID = $params['rankID'];
        $model->rankName = $params['rankName'];
        $model->rankStatus = $params['rankStatus'];
        $model->displayOrder = $params['displayOrder'];
        return $model;
    }
    
    public function getAll() {
        return Rank::find()
                ->select(['rankID', 'rankName'])
                ->where(['rankStatus' => 1])
                ->orderBy(['displayOrder' => SORT_ASC])
                ->all();
    }
}
