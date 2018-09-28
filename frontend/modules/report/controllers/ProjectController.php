<?php
namespace app\modules\report\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use app\controllers\MyController;
use common\Untils;
use app\modules\report\models\ProjectModel;
class ProjectController extends MyController {
 
    public $functionId = 12;   
    public function actionIndex() {
        parent::check();
        return $this->render('index');
    }

    public function actionGetProjectReportBy(){
    	Yii::$app->response->format = Response::FORMAT_JSON;
        try {
         	$params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
         	if (ProjectModel::isNotNullOrEmpty($params['sectionID']) 
         		&& $params['sectionID'] == 0)
	            return[
	            	'saleSDC' => ProjectModel::getProjectAllSection('SDC',$params),
	            	'salePM' => ProjectModel::getProjectAllSection('PM',$params),
	            	'plan' => ProjectModel::getProjectAllSection('Plan',$params),
	            	'assignment' => ProjectModel::getProjectAllSection('Assignment',$params),
	                'error' => 0
	            ];
	            else
	            return[
	            	'saleSDC' => ProjectModel::getSaleSDC($params),
	            	'salePM' => ProjectModel::getSalePM($params),
	            	'plan' => ProjectModel::getPlan($params),
	            	'assignment' => ProjectModel::getAssignment($params),
	                'error' => 0
	            ];
        } 
        catch (Exception $e) {
            Untils::handleExceptionOfAngular($e);
        }
    }
}


