<?php
namespace app\modules\login;

use yii\base\Module;

class Login extends Module {
    public $controllerNamespace = 'app\modules\login\controllers';
    
    public function init() {
        parent::init();
        $this->layout = false;
    }
}
