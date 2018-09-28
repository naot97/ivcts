<?php
namespace app\modules\report\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use \yii\helpers\ArrayHelper;
use \yii\filters\VerbFilter;
use app\controllers\MyController;
use common\Untils;
use app\modules\report\models\effortModel;
class EffortController extends MyController {
    private $reportModel;
    public $functionId = 12;
    
  /*  public function behaviors() {
        return ArrayHelper::merge(parent::behaviors(), [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'index' => ['GET'],
                        'export-report' => ['POST'],
                    ],
                ],
        ]);
    }*/
    
    public function actionIndex() {
        parent::check();
        return $this->render('index');
    }

    public function actionGetEffortListBy(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return[
                'list' => effortModel::getListByLevel($params),
                'error' => 0
            ];
        } catch (Exception $e) {
            Untils::handleExceptionOfAngular($e);
        }
    }

    public function actionGetDetailBy(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $params = json_decode(Yii::$app->getRequest()->getRawBody(), true);
            return[
                'list' => effortModel::getDetailList($params),
                'error' => 0
            ];
        } catch (Exception $e) {
            Untils::handleExceptionOfAngular($e);
        }
    }
}

