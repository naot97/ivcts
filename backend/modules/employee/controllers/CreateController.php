<?php
namespace app\modules\employee\controllers;

use yii\base\Controller;
use common\models\Account;
use common\models\EmployeeCreate;
use common\models\Level;
use common\models\Section;
use common\models\Rank;
use yii;

class CreateController extends Controller {
    public function actionIndex() {
           	$model = new EmployeeCreate();
            if ($model->load(Yii::$app->request->post()))
                $model->create();
            $levels = Level::find()->all();
            $sections = Section::find()->all();
            $ranks = Rank::find()->all();
    		return $this->render('index',['model' =>$model, 'levels' => $levels,'sections' => $sections,'ranks' => $ranks]);
	    	
       
    }
}
