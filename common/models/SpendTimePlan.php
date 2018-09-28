<?php
namespace common\models;

use yii\db\ActiveRecord;

class SpendTimePlan extends ActiveRecord {
    
    public static function tableName() {
        return '{{spend_time_plan_r}}';
    }
}
