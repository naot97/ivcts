<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\models\Account;
use common\models\Section;
use common\models\Level;
use common\models\Rank;
use yii;

class Employee extends ActiveRecord implements IdentityInterface{
    
   
    public static function tableName() {
        return '{{employee}}';
    }
     public static function findIdentity($id)
      {
          return static::findOne($id);
      }
 
      public static function findIdentityByAccessToken($token, $type = null)
     {
          return static::findOne(['access_token' => $token]);
      }
 
     public function getId()
      {
          return $this->employeeID;
     }
 
      public function getAuthKey()
      {
          return $this->authKey;
      }
 
      public function validateAuthKey($authKey)
      {
          return $this->authKey === $authKey;
      }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    public function getUserName(){
        /*return $this->hasOne(Account::className(), ['employeeId' => 'employeeID'])->one()->username;*/
        return $this->username;
    }
    public function getSectionName(){
         $s =$this->hasOne(Section::className(), ['sectionID' => 'sectionID'])->one();
         if (isset($s))
            return $s->sectionName;
         else
            return '(not set)';
    }
    public function getLevelName(){
        $l = $this->hasOne(Level::className(), ['levelID' => 'levelID'])->one();
        if (isset($l))
            return $l->levelName;
         else
            return '(not set)';
    }
    public function getRankName(){
        $r = $this->hasOne(Rank::className(), ['rankID' => 'rank'])->one();
        if (isset($r))
            return $r->rankName;
         else
            return '(not set)';
    }
    public function __contruct($name,$code,$sectionId,$levelId,$rank,$employeeStatus,$supervisorId,$birthDate,$startDate,$endDate,$telephone,$mobile,$email,$marital,$regisAdd,$currentAdd){

      $this->employeeName = $name;
      $this->employeeCode = $code;
      $this->sectionID = $sectionId;
      $this->levelID = $levelId;
      $this->rank = $rank;
      $this->employeeStatus = $employeeStatus;
      $this->supervisorId = $supervisorId;
      $this->DoB = $birthDate;
      $this->startDate = $startDate;
      $this->endDate = $endDate;
      $this->telephone = $telephone;
      $this->mobile = $mobile;
      $this->email = $email;
      $this->maritalStatus = $marital;
      $this->registeredAddress = $regisAdd;
      $this->currentAddress = $currentAdd;

    }
   
}
