<?php
namespace app\views\layouts\partials;
use yii;
use common\models\Privilege;
use common\models\Power;
use common\models\GroupPrivilege;
use yii\helpers\Html;
use common\Untils;
    
?>
<div class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
<?php
        $acc = Yii::$app->user->identity;
    if (!Yii::$app->user->isGuest){

       $isAdmin = $acc->isAdmin;
       $employeeID = $acc->employeeID;

       $listGroup = GroupPrivilege::find()->all(); 
       $listPow = Power::find()->where(['accountId' => $employeeID])->all();
       $listPri = Privilege::find()->all();

       if ($isAdmin) $listPriOfAcc = $listPri;
       else{
            $listPriOfAcc = array();
            foreach ($listPow as $pow) {
                foreach ($listPri as $pri) {
                    if ($pow->privilegeId === $pri->privilegeId)
                        array_push($listPriOfAcc,$pri);
                }
           }
        }
      Untils::writeNoChild('/dashboard','Dashboard','fa-home');
       foreach ($listGroup as $group) {
            $arrChild = array();
            foreach ($listPriOfAcc as $pri) 
                if ($pri->groupId === $group->groupId)
                    array_push($arrChild,$pri);

            if (sizeof($arrChild) > 0){
              echo Html::beginTag('li');
              Untils::writeParent($group->name,$group->icon);
              echo Html::beginTag('ul',['style'=>'list-style-type:disc','aria-expanded' => 'false','class' => 'collapse']);
              foreach ($arrChild as $child) 
                  Untils::writeChild($child->link,$child->name);
              echo Html::endTag('ul');
              echo Html::endTag('li');
          }
        }
       Untils::writeNoChild('/suggestion','Suggestion','fa-question'); 
       Untils::writeNoChild('/simulation','Simulation','fa-eye');
        
    }
?>             
            </ul>
        </nav>
    </div>
</div>
