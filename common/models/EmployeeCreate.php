<?php
namespace common\models;
use common\models\Employee;
class EmployeeCreate extends Employee{
    public $confirmPassword  ;
    public function __construct(){
        $this->confirmPassword = $this->password;
        parent::__construct();
    }
    public function rules()
    {
        return [
            [['username', 'password','confirmPassword' ,'employeeName','employeeCode','levelID','sectionID','rank','currentAddress'], 'required'],
            ['email','email'],
            [['employeeCode','username'],'unique'],
            ['mobile','number'],

        ];
    } 

    public function create(){
    	if ($this->validate()){
    		$acc = Account::findOne( ['username' => $this->username] );
    		if (!isset($acc) && $this->password === $this->confirmPassword){
    			$this->setPassword($this->password);
    			$this->save();
    		}
    		else var_dump($this->username);
    	}
    }

    public function updateInfo(){
        $this->confirmPassword = $this->password;
        if ($this->validate()) {
            if ($this->password === $this->confirmPassword){
                $this->setPassword($this->password);
                $this->save();
            }
        }
       /* else {
            $this->validate();
            $oldPass = Employee::findOne($this->employeeID)->password;
            $this->update();
            $this->password = $oldPass;
            $this->update();
        }*/
    }
} 
?>
