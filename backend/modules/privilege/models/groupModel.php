<?php
namespace app\modules\privilege\models;
use common\models\GroupPrivilege;
use yii\db\ActiveRecord;
use yii\base\Model;
use common\models\Privilege;
class groupModel extends Model{
    public function create($params){
        $newGroup = new GroupPrivilege();
        $newGroup->name = $params['groupName'];
        $newGroup->save();
    }

    public function updateGroup($params){
    	$groupId = $params['groupId'];
    	$group = GroupPrivilege::findOne($groupId);
    	$group->name = $params['groupName'];
    	return $group->update();
    }

    public function isEmptyGroup($params){
    	$groupId = $params['groupId'];
    	if (sizeof(Privilege::findOne(['groupId' => $groupId]) === 0))
    		return true;
    	else return false;
    }

    public function deleteGroup($params){
    	$groupId = $params['groupId'];
    	$group = GroupPrivilege::findOne($groupId);
    	return $group->delete();
    }

    
}
?>

