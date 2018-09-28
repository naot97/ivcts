<?php
namespace frontend\models;

use yii\base\Model;
use common\models\Employee;

class EmployeeModel extends Model {
    
    public function mergeData($model, $params) {
        $model->employeeID = $params['employeeID'];
        $model->employeeName = $params['employeeName'];
        $model->employeeCode = $params['employeeCode'];
        $model->levelID = $params['levelID'];
        $model->username = $params['username'];
        $model->password = $params['password'];
        $model->employeeStatus = $params['employeeStatus'];
        $model->sectionID = $params['sectionID'];
        $model->isAdmin = $params['isAdmin'];
        $model->salt = $params['salt'];
        $model->supervisorID = $params['supervisorID'];
        $model->startDate = $params['startDate'];
        $model->endDate = $params['endDate'];
        $model->lastUpdate = $params['lastUpdate'];
        $model->DoB = $params['DoB'];
        $model->maritalStatus = $params['maritalStatus'];
        $model->telephone = $params['telephone'];
        $model->mobile = $params['mobile'];
        $model->registeredAddress = $params['registeredAddress'];
        $model->currentAddress = $params['currentAddress'];
        $model->email = $params['email'];
        $model->rank = $params['rank'];
        $model->ivisAccount = $params['ivisAccount'];
        $model->redmineAccount = $params['redmineAccount'];
        return $model;
    }
    
    public function getEmployees($s) {
        $query = 'SELECT sectionID,employeeID, CONCAT(employeeCode, \' - \', employeeName) AS employeeName '
               . 'FROM ' . Employee::tableName() . ' '
               . 'WHERE employeeStatus = 1 '                
               . (($s === null || $s === '') ? ' ' :  'AND sectionID = '. $s .' ')
               . ' ORDER BY sectionID ASC'
               ;
        return  Employee::findBySql($query)->all();
    }   
    
}
