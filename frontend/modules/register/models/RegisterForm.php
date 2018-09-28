<?php
namespace app\modules\register\models;

use yii\base\Model;
use common\models\Account;
use yii;
class RegisterForm extends Model{

	public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password','confirmPassword','employeeId'], 'required'],
            // rememberMe must be a boolean value
        ];
    }
	public $username;
	public $password;
	public $confirmPassword;
	public $employeeId;
	public function check(){
		if (Account::findOne(['username' => $this->username]) || Account::findOne(['password' =>$this->password]) || ($this->password !== $this->confirmPassword) )
			return false;
		else return true;
	}

	public function regist(){
		var_dump($this);
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
