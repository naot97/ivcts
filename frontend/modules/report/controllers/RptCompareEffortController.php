<?php
namespace app\modules\report\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use \yii\helpers\ArrayHelper;
use \yii\filters\VerbFilter;
use app\modules\report\models\ReportModel;
use app\controllers\MyController;

class RptCompareEffortController extends MyController {
    private $reportModel;
    public $functionId = 11;
    public function __construct($id, $module, $config = array()) {   
        if($this->reportModel === null) {
            $this->reportModel = new ReportModel();
        }
        parent::__construct($id, $module, $config);
    }
    
    public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'index' => ['GET'],
                        'export-report' => ['POST'],
                    ],
                ],
        ]);
    }
    
    public function actionIndex() {
        parent::check();
        return $this->render('index');
    }
    
    public function actionExportReport() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return [
                'lstReport' => $this->reportModel->exportReport($params),
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
