<?php
namespace app\modules\employee\models;

use common\models\Account;
use common\Untils;

class AccountModel extends Account
{
	public function rules()
    {
        return [
            [['username','password','isAdmin','employeeId'], 'required'],
            ['username','unique'],
            ['isAdmin','boolean']
        ];
    } 
	public function mergeData($params){
		$this->username = $params['username'];
		$this->setPassword($params['password']);
		$this->employeeId = $params['employeeId'];
		$this->isAdmin = $params['isAdmin'];
	}
	public function saveAccount($params){
		$isCreate = $params['isCreate'];
		$account = $isCreate ? new AccountModel() : AccountModel::findOne(['employeeId' => $params['employeeId'], 'isDeleted' => 0]);
		$account->mergeData($params);
		if ($account->validate())
			return [
				'error' => (( $isCreate ? $account->save() : $account->update()) ? 0 : 1),
				'message' => 'You can\'t save anything' 
			];
		else return [
			'error' => 1,
			'message' => Untils::complexArrayToString($account->getErrors())
		];
	}
}
?>
