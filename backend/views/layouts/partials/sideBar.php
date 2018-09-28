<?php
namespace app\views\layouts\partials;
use yii;
use common\models\Privilege;
use common\models\Power;
use common\models\GroupPrivilege;
use common\Untils;
use yii\helpers\Html;
  
?>
<div class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
<?php
        $acc = Yii::$app->user->identity;
    if (!Yii::$app->user->isGuest){ // co dang nhap chua
       $isAdmin = $acc->isAdmin; 
       if ($isAdmin) { // co phai la admin
            //admin
            Untils::writeNoChild('/admin','Grand Privilege','fa-eye');
            //privilege
            Untils::writeNoChild('/privilege','Privilege','fa-book');
           // echo Html::beginTag('li');
            //Untils::writeParent('Privilege','fa-user');
            //Untils::createList();
            //Untils::writeChild('/privilege/create','Create');
            //Untils::writeChild('/privilege/delete','Delete');
            //echo Html::endTag('ul');
            //echo Html::endTag('li');
            //employee
            Untils::writeNoChild('/employee','Employee & Account','fa-user');
            Untils::writeNoChild('/period','Period','fa-calendar');
            /*echo Html::beginTag('li');
            Untils::writeParent('Employee','fa-user');
            Untils::createList();
            Untils::writeChild('/employee/create','Create');
            Untils::writeChild('/employee/manage','Manage');
            echo Html::endTag('ul');
            echo Html::endTag('li');*/
        }     
    }
?>             
            </ul>
        </nav>
    </div>
</div>
