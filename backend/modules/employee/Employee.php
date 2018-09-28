<?php
namespace app\modules\employee;

use yii\base\Module;

class Employee extends Module {
    public $controllerNamespace = 'app\modules\employee\controllers';
    
    public function init() {
        parent::init();
    }

     public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
}
