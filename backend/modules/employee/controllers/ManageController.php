<?php
namespace app\modules\employee\controllers;

use yii\base\Controller;
use common\models\Account;
use common\models\Employee;
use common\models\Level;
use common\models\Section;
use common\models\Rank;
use common\models\EmployeeCreate;
use yii;
use yii\data\ActiveDataProvider;


class ManageController extends Controller {
    public function actionIndex() {
        $query = Employee::find()->where(['isDeleted' => 0,'isAdmin' => 0]);
        $data = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 10,
        ],
         'sort' =>[],
    	]);	
               return $this->render('index',['data' => $data]);
    }

    public function actionDelete(){
        if (isset($_GET['id'])) {
            $e = Employee::findOne($_GET['id']);
            var_dump($e);
            $e->isDeleted = 1;
            $e->update();
        }
        return $this->actionIndex();
    }

    public function actionUpdate(){
        $levels = Level::find()->all();
        $sections = Section::find()->all();
        $ranks = Rank::find()->all();
        $model = EmployeeCreate::findOne($_GET['id']);
        $request = Yii::$app->request;
        /*if (!isset($_POST['confirmPassword'])){
            unset(Yii::$app->request->post('confirmPassword'));
            $_POST['confirmPassword'] = false;
            var_dump(Yii::$app->request->post());
        }*/
        if ($model->load($request->post())) {
            $model->updateInfo();
        }
        return $this->render('update',['model' => $model,'levels' => $levels,'sections' => $sections,'ranks' => $ranks]);
    }

}

