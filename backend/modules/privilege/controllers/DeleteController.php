<?php
namespace app\modules\privilege\controllers;

use yii\base\Controller;
use common\models\Account;
use common\models\Privilege;
use common\models\GroupForm;
use yii;
use common\models\GroupPrivilege;

class DeleteController extends Controller {
    public function actionIndex() {
            // check
    		if (!isset(Yii::$app->user->identity) || Yii::$app->user->identity->__get('isAdmin') === 0 ) throw new Exception("Error Processing Request", 1);
            // solve method post
    		$model = new Privilege();
            $request = Yii::$app->request;
            $model->load($request->post());
            if (isset($_POST['delete-pri-button']))
                $model->deletePri();
            else if (isset($_POST['delete-group-button']))
                $model->deleteGroup();

            // load data to views
    		$groups = GroupPrivilege::find()->all();
            $privileges = Privilege::find()->all();
    		return $this->render('index',['model' => $model, 'groups' => $groups, 'privileges' => $privileges,
            ]);
	    	
        }
        
    }

