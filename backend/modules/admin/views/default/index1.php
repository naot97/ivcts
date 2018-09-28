<?php
namespace app\modules\admin;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Power;
use common\models\Privilege;
use yii;
$this->title = 'Grand Privilege';
?>
<div class="card card-outline-info row">            
<div class="card-body">          
<div class="form-body ">
<h4 class="card-header text-white ">Change Power</h4>

<?php
function writeOption($value,$name){
	echo Html::beginTag('option',['value' => $value]);
		echo $name;
	echo Html::endTag('option');
}
?>
<div class="row">
<div class="col-md-12">
<?php
$form = ActiveForm::begin([]); 
	echo Html::beginTag("div",['class' =>'row p-t-20',]);
        echo Html::beginTag('div',['class' =>"col-md-3 form-group" , ]);

        echo Html::tag('label',"Account",['class' => 'control-label']);
		/*echo Html::activeDropDownList($modelAcc,'accountId',ArrayHelper::map($items,
			'accountId','username'),['onchange' => "","name" => "listAcc",'class' => 'form-control' ]);*/
        $l = array();
        foreach ($items as $acc) {
            $l[$acc->accountId] = $acc->accountId.'-'.$acc->username;
        }

        echo Html::beginTag('div',['style' => 'overflow-y: scroll;']);
        echo $form->field($modelEm, 'accountId',['template' => '<div class=\"\">{input}</div><div class=\"\">{error}</div>'])->checkboxList($l);
        echo Html::endTag('div');
        echo Html::endTag('div');
        echo Html::beginTag('div',['class' =>"col-md-3 form-group" ]);
            echo Html::tag('label',"Privilege",['class' => 'control-label']);

		echo Html::activeDropDownList($modelPri,'privilegeId',ArrayHelper::map($privileges,'privilegeId','name'),['onchange' => "", "name" => "listPri",'class' => 'form-control']);
        echo Html::endTag('div');
        echo Html::beginTag('div',['class' =>"col-md-3 form-group" ]);
            echo Html::tag('label',"Power",['class' => 'control-label']);
		      echo Html::beginTag('select',['name' => 'listPow','class' => 'form-control']);
			     writeOption("wr","Read-Write");
			     writeOption("r","Read");
			     writeOption("n","None");	
		      echo Html::endTag('select');
        echo Html::endTag('div');
?>
        <div class="col-md-2">
            <div class="form-group offset-3 p-t-30 p-l-0">
                <button ng-click="ExportReport()" class="btn btn-primary"><i class="fa fa-arrow-right"></i>Submit</button>
            </div>
        </div>
    <?php
  echo Html::endTag('div');
ActiveForm::end();
	
?>
</div>
</div>
<hr>
<div class="form-body">
<h4 class="card-header text-white ">Power Info</h4>
<div class="p-t-20">
<table class="display nowrap table table-hover table-bordered " cellspacing="0" width="100%">
    <thead>
        <tr>
        	<th> Account Id </th>
  			<th> Account Name </th>
           	<?php
           		foreach ($privileges as $pri) {
           			echo Html::tag('th',$pri->__get('name'));
           		}
           	?>    
        </tr>
    </thead>
    <tbody >
    	  <?php
    	  		foreach ($items as $em) {
    	  			$accountId = $em->__get('accountId');
                    echo Html::beginTag('tr');
    	  			echo Html::tag('td',$accountId);
    	  			echo Html::tag('td',$em->__get('username'));
    	  			foreach ($privileges as $pri) {
    	  				$text = "None";
    	  				$privilegeId = $pri->__get('privilegeId');
                        unset($p);
                        foreach ($powers as $pow) {
                            if ($pow->accountId == $accountId && $pow->privilegeId == $privilegeId )
                                $p = $pow;
                        }
    	  				if (isset($p) ){
    	  					if ($p->validateCodePower('wr') )
    	  					$text = 'Read-Write'; 
    	  					else $text = 'Read';
    	  				}
    	  				echo Html::tag('td',$text);
    	  			}
                    echo Html::endTag('tr');
    	  		}
    	  ?>
    </tbody>
</table>
</div>
</div>
</div>
</div>


    


