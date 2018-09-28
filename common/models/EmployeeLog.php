<?php
namespace common\models;

use yii\db\ActiveRecord;

class EmployeeLog extends ActiveRecord {
    
    public static function tableName() {
        return '{{employee_l}}';
    }
}

