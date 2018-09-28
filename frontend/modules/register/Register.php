<?php
namespace app\modules\register;

use yii\base\Module;

class Register extends Module {
    public $controllerNamespace = 'app\modules\register\controllers';
    
    public function init() {
        parent::init();
        $this->layout = false;
    }
}
