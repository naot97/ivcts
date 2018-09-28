<?php
namespace app\modules\privilege\controllers;

use yii\base\Controller;
use common\models\Account;
use common\models\Privilege;
use common\models\GroupForm;
use yii;
use common\models\FormPri;
use common\models\GroupPrivilege;

class CreateController extends Controller {
    public function actionIndex() {
            // check
    		if (!isset(Yii::$app->user->identity) || Yii::$app->user->identity->__get('isAdmin') === 0 ) throw new Exception("Error Processing Request", 1);
            // solve method post
    		$model = new Privilege();
            $request = Yii::$app->request;
            $model->load($request->post());
            if (isset($_POST['create-button'])){
                $model->value = $request->post('listPow');
                $model->create();
            }

            // load data to views
    		$groups = GroupPrivilege::find()->all();
            $groups2 = $groups; 
            $privileges = Privilege::find()->all();
    		$new = new Privilege();
    		$new->groupId = 0;
    		$new->name = "New Group";
    		array_unshift($groups , $new);
    		return $this->render('index',['model' => $model, 'groups' => $groups, 'privileges' => $privileges,
            'groups2' => $groups2 ]);
	    	
        }
        
    }

