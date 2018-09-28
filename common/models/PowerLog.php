<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii;
class PowerLog extends ActiveRecord {
    
    public static function tableName() {
        return '{{power_l}}';
    }
    public function validateCodePower($code)
    {
        return Yii::$app->security->validatePassword($code, $this->value);
    }

    public function setCodePower($code)
    {
        return Yii::$app->security->generatePasswordHash($code);
    }

}


