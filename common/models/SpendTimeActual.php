<?php
namespace common\models;

use yii\db\ActiveRecord;

class SpendTimeActual extends ActiveRecord {
    
    public static function tableName() {
        return '{{spend_time_actual_r}}';
    }
}
