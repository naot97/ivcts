<?php
namespace common\models;

use yii\db\ActiveRecord;

class Period extends ActiveRecord {
    
    public static function tableName() {
        return '{{period}}';
    }
}
