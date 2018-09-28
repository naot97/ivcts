<?php
namespace app\modules\common\controllers;

use Yii;
use yii\web;
use yii\web\Response;
use yii\web\Controller;
use \yii\helpers\ArrayHelper;
use \yii\filters\VerbFilter;
use frontend\models\LevelModel;
use frontend\models\SectionModel;
use frontend\models\PeriodModel;
use frontend\models\RankModel;
use frontend\models\TypeModel;
use frontend\models\EnumDefineModel;
use frontend\models\ProjectGroupModel;
use frontend\models\ProjectModel;
use frontend\models\EmployeeModel;
use app\controllers\MyController;
use common\Untils;
class DefaultController extends MyController {
    
    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'get-section' => ['GET'], 
                        'get-period' => ['GET'], 
                        'get-rank' => ['GET'], 
                        'get-type' => ['GET'], 
                        'get-enum-define' => ['GET'], 
                        'get-project-group' => ['GET'],
                        'get-project' => ['GET'],
                        'get-employee' => ['GET'],
                        'get-level' => ['GET'],
                    ],
                ],
        ]);
    }
    public function actionGetLevel(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try{
            $level = new LevelModel();
            return[
                'level' => $level->getAll(),
                'error' => 0
            ];
        }
        catch(\Exception $ex){
            return Untils::handleExceptionOfAngular($ex);
        }
    }
    public function actionGetSection() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $section = new SectionModel();
            return [
                'section' => $section->getAll(),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionGetPeriod($m, $y) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $period = new PeriodModel();
            $params = [
                'month' => $m,
                'year' => $y
            ];
            return [
                'period' => $period->getPeriodBy($params),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionGetRank() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $rank = new RankModel();
            return [
                'rank' => $rank->getAll(),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionGetType() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $type = new TypeModel();
            return [
                'type' => $type->getAll(),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }

    public function actionGetEnumDefine($id) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $enum = new EnumDefineModel();
            $tblName = '';
            $colName = '';
            switch ($id) {
                case 1: 
                    $tblName = 'project';
                    $colName = 'projectStatus';
                    break;
                case 2: 
                    $tblName = 'project';
                    $colName = 'OTStatus';
                    break;
                case 3: 
                    $tblName = 'period';
                    $colName = 'periodStatus';
                    break;
            }
            
            return [
                'EnumData' => $enum->getEnumDefineBy($tblName, $colName),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionGetProjectGroup() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $projectGroup = new ProjectGroupModel();
            return [
                'projectGroup' => $projectGroup->getAll(),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionGetProject() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $project = new ProjectModel();
            return [
                'project' => $project->getProjects(),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
    
    public function actionGetEmployee($s = null) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $employee = new EmployeeModel();
            return [
                'employee' => $employee->getEmployees($s),
                'error' => 0,
            ];
        } catch (Exception $exc) {
            return [
                'message' => $exc->getTraceAsString(),
                'error' => 1,
            ];
        }
    }
}
