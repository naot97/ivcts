<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Period;

class PeriodModel extends Model {
    
    public function mergeData($model, $params) {
        $model->periodID = $params['periodID'];
        $model->month = $params['month'];
        $model->year = $params['year'];
        $model->workingHour = $params['workingHour'];
        $model->periodStatus = $params['periodStatus'];
        return $model;
    }
    
    private function getAll() {
        return Period::find()
                ->orderBy([
                    'periodStatus' => SORT_ASC,
                    'year' => SORT_DESC,
                    'month' => SORT_DESC,
                    'workingHour' => SORT_DESC
                    ])
                ->all();
    }
    
    public function getPeriodBy($params) {        
        $query = 'SELECT periodID, year, month, workingHour '
               . 'FROM ' . Period::tableName() . ' '
               . 'WHERE periodStatus = 1 '
               . (($params['month'] != null && $params['month'] != '')
               ? '  AND month = '.$params['month'] : '')
               . (($params['year'] != null && $params['year'] != '')
               ? '  AND year = '.$params['year'] : '')
               . '  ORDER BY month DESC, year DESC';
        
        return Period::findBySql($query)
                ->orderBy([
                    'year' => SORT_DESC,
                    'month' => SORT_DESC,
                    'workingHour' => SORT_DESC
                    ])
                ->all();
    }
}
