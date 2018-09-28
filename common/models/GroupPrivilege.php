<?php
namespace common\models;

use yii\db\ActiveRecord;

class GroupPrivilege extends ActiveRecord {
    
    public static function tableName() {
        return '{{group_privilege}}';
    }
}
