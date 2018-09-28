<?php
namespace common\models;

use yii\base\Model;
use common\models\Account;
use yii;
class RegisterForm extends Model{

	public $username;
	public $password;
	public $confirmPassword;
	public $employeeId;
	public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }
	public function check(){
		if (Account::findOne(['username' => $this->username]) || Account::findOne(['password' =>$this->password]) || ($this->password !== $this->confirmPassword) )
			return false;
		else return true;
	}

	public function regist(){
		throw new Exception("Error Processing Request", 1);
		
		if ($this->check()){
			$acc = new Account();
			$acc->username = $this->username;
			$acc->setPassword($this->password);
			$acc->employeeId = $this->employeeId;
			$acc->save();
		}
	}


}

?>
