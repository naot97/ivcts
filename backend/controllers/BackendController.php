<?php
namespace app\controllers;

use yii\base\Controller;
use yii;
class BackendController extends Controller
{
	public function behaviors(){
    	return [
    		];
    }
	public function checkAdminLogin(){
		if ( !isset(Yii::$app->user->identity) || Yii::$app->user->identity->__get('isAdmin') === 0 )            
    			Yii::$app->response->redirect(Yii::$app->request->baseUrl.'/login');
	}
}

?>
