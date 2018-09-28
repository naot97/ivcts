<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\models\Power;
use common\models\Employee;

class Privilege extends ActiveRecord  {
    
    public static function tableName() {
        return '{{privilege}}';
    }
    public $value;
    public $groupName;
    public function rules()
      {
          return [
              [['name','functionId','groupId'], 'required'],
              ['functionId','unique'],
          ];
      }

      public function createInDataBase($privilegeId,$name,$functionId,$link,$groupId,$value){
        $this->changeInfo($privilegeId,$name,$functionId,$link,$groupId,$value);
        if ($this->validate()){
          if (!$this->save()) return false;
          if (isset($this->value)){
            if ($this->value !== 'n'){
              $listEmployee = Employee::find()->where(['isAdmin'=> 0,'employeeStatus' => 1 ])->all();
              foreach ($listEmployee as $em) {
                $pow = new Power();
                $pow->setAttri($em->employeeID,$this->privilegeId,$this->value);
                $pow->save();
              }
            }
          }
          return true;
        }
        return false;
      }

      public function deletePri(){
        $p = self::findOne($this->privilegeId);
        if (isset($p))
          $p->delete();
      }

      public function deleteGroup(){
        $g = GroupPrivilege::findOne($this->groupId);
        if (isset($g))
          $g->delete();
      }

      public function changeInfo($privilegeId,$name,$functionId,$link,$groupId,$value){
        $this->privilegeId = $privilegeId;
        $this->name = $name;
        $this->functionId = $functionId;
        $this->link = $link;
        $this->groupId = $groupId;
        $this->value = $value;
        $this->groupName = GroupPrivilege::findOne($groupId)->name;
        //$this->link =  "/".strtolower($this->groupName)."/".strtolower(str_replace(" ","-",$this->name));
      }

      public function updatePower(){
        if (isset($this->value)){
            if ($this->value !== 'n' && $this->value !== 'k'){// neo k null hoac keep stable
              $listEmployee = Employee::find()->where(['isAdmin'=> 0,'employeeStatus' => 1 ])->all();
              foreach ($listEmployee as $em) {
                // tao power hoac lay power tu database
                $pow = Power::findOne(['accountId' => $em->employeeID,'privilegeId' => $this->privilegeId]);
                $isNew = false;
                if (!isset($pow)){
                  $pow = new Power();
                  $isNew = true;                 
                }
                // chinh power theo input value
                $pow->setAttri($em->employeeID,$this->privilegeId,$this->value);
                //tao moi hoac update tren database
                if ($isNew) $pow->save();
                else $pow->update();
              }  
            }
            else if ($this->value === 'n'){// neo laf none thi xoa tat ca pow lien quan den privilege Id
              $pows = Power::find()->where(['privilegeId' => $this->privilegeId] )->all();
              foreach ($pows as $pow) {
                $pow->delete();
              }
            }      
          }
        else return false; // return false neu k co vlue
        return true;
      }

      public function updateInDatabase($privilegeId,$name,$functionId,$link,$groupId,$value){
          $this->changeInfo($privilegeId,$name,$functionId,$link,$groupId,$value);
          if ($this->validate()){
              $condi1 = $this->update();
              $condi2 = $this->updatePower();
              return $condi1 || $condi2;
            }
          return false;
      }
}
