<?php
namespace common\models;

use yii\db\ActiveRecord;

class Rank extends ActiveRecord {
    
    public static function tableName() {
        return '{{rank}}';
    }
}
