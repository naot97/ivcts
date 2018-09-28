<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\GroupPrivilege;

class GroupForm extends Model{
	public $groupId;
	public $groupName;
	public function rules()
    {
        return [
            [['groupId', 'groupName'], 'required'],
        ];
    }

	public function create(){
		if ($this->groupId === "0" && $this->validate()) {
			$newGroup = new GroupPrivilege();
			$newGroup->name = $this->groupName;
			$newGroup->save();
			$this->groupId	 = $newGroup->groupId;
		}
	}

	public function delete(){
		$groupName = "";
		if ($this->validate()){
			$group = GroupPrivilege::findOne($this->groupId);
			$group->delete();
		}

	}
}
?>

