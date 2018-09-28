<?php
namespace app\modules\privilege\models;
use common\models\Privilege;
use yii\db\ActiveRecord;
use yii\base\Model;
class priModel extends Model{
	

    public function getlstPri($params){
    
        return Privilege::find()->filterWhere(['AND',
          ['LIKE','functionId',$params['functionId']],
          ['LIKE','name',$params['privilegeName']],
          ['LIKE','link',$params['privilegeLink']],
          ['LIKE','groupId',$params['groupId']]])->all();
    }

    public function deletePrivilege($params){
      return (Privilege::findOne($params['privilegeId']))->delete();
    }

    public function createPrivilege($params){
        $newPri = new Privilege();
        return $newPri->createInDataBase($params['privilegeId'],$params['privilegeName'],$params['functionId'],$params['privilegeLink'],$params['groupId'],$params['value']);
      }

    public function updatePrivilege($params){
        $pri = Privilege::findOne($params['privilegeId']);
        return $pri->updateInDataBase($params['privilegeId'],$params['privilegeName'],$params['functionId'],$params['privilegeLink'],$params['groupId'],$params['value']);
    }
}
?>
