<?php
namespace common\models;

use yii\db\ActiveRecord;

class ProjectSaleplan extends ActiveRecord {
    
    public static function tableName() {
        return '{{project_saleplan_r}}';
    }
}
