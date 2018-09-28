<?php
namespace common\models;

use yii\db\ActiveRecord;

class Project extends ActiveRecord {
    
    public static function tableName() {
        return '{{project_r}}';
    }
    
    public function rules() {
        return [
            ['endDate', 'default', 'value' => null]
        ];
    }
}
