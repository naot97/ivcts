<?php

namespace common\models;
use yii\base\Model;
use common\models\Employee;
use yii;
class LoginForm extends Model{
	public $username ='';
	public $password = '';
	public $rememberMe = false;

	public $acc;

	public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $acc = $this->acc;
            if (!$acc || !$acc->validatePassword($this->password)) 
            	return false;
        }
        return true;

    }

    public function getAcc(){
    	$this->acc = Employee::findOne(['username'=> $this->username,'employeeStatus' => 1]);
    }
    public function adminLogin(){
       $this->getAcc(); 
       if ($this->validate() && $this->validatePassword()&& $this->acc->isAdmin ) {
           Yii::$app->user->login($this->acc, $this->rememberMe ?  3 : 0); 
           return true;
        }
        else return false;
    }
    public function login()
    {
        $this->getAcc();
        if ($this->validate() && $this->validatePassword() ) {
           Yii::$app->user->login($this->acc, $this->rememberMe ? 3 : 0); 
           return true;
        }
        else return false;
    }

}
?>
