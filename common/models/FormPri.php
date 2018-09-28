<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\Privilege;
use common\models\GroupPrivilege;

class FormPri extends Model{
	public $privilegeId ;
	public $name;
	public $groupId;
	public $groupName;
	public function rules()
    {
        return [
            [['name','privilegeId','groupId','groupName'], 'required'],
            ['privilegeId','unique']
        ];
    }

	public function create(){
		if ($this->vadilate()){
			if ($this->groupId === "0" ) {
				$newGroup = new GroupPrivilege();
				$newGroup->name = $this->groupName;
				$newGroup->save();
				$this->groupId	 = $newGroup->groupId;
			}
			$newPri = new Privilege();
			$newPri->name = $this->name;
			$newPri->groupId = $this->groupId;
			$newPri->link =  "/".strtolower($this->groupName)."/".strtolower(str_replace(" ","-",$this->name));
			$newPri->save();
		}
	}

	public function deletePri(){
		$p = Privilege::findOne($this->privilegeId);
		if (isset($p))
			$p->delete();
	}

	public function deleteGroup(){
		$g = GroupPrivilege::findOne($this->groupId);
		if (isset($g))
			$g->delete();
	}

}
?>

