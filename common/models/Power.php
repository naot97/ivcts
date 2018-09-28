<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class Power extends ActiveRecord  {
    public static function tableName() {
        return '{{power}}';
    }
      public function setAttri($accId,$priId,$pow){
        $this->__set('accountId',$accId);
        $this->__set('privilegeId',$priId);
        $this->__set('accountPower',$this->setCodePower($pow));

      }


    public function validateCodePower($code)
    {
        return Yii::$app->security->validatePassword($code, $this->accountPower);
    }

    public function setCodePower($code)
    {
        return Yii::$app->security->generatePasswordHash($code);
    }
}
