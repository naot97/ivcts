<?php
namespace common\models;

use yii\db\ActiveRecord;

class EnumDefine extends ActiveRecord {
    
    public static function tableName() {
        return '{{enum_define}}';
    }
}
