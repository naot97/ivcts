<?php
namespace common\models;

use yii\db\ActiveRecord;

class ProjectGroup extends ActiveRecord {
    
    public static function tableName() {
        return '{{project_group}}';
    }
}
