<?php
namespace app\modules\privilege;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Power;
use yii;
$this->title = '';
?>
<script type="text/javascript">
	function changeVisi(value) {
		 if (value != 0 )
		 	 document.getElementById("groupPanel").style.visibility = "hidden"; 
		 else  document.getElementById("groupPanel").style.visibility = "visible"; 
	}
</script>

<div class="card card-outline-info ">   
	<div class="card-body ">         
	<div class=" form-body ">      
			<h4 class="card-header text-white">Create Privilege</h4>
			<div class="p-t-20 container row">
				<?php
					$form = ActiveForm::begin([]); 
				?>
				<div class="form-group row container">
                    <?= $form->field($model, 'name')->textInput() ?>
				</div>
				<div class=" row ">
					<div class = "form-group col-md-6">
					<?= $form->field($model,'groupId')->dropDownList(ArrayHelper::map($groups, 'groupId', 'name'),['onchange' => "changeVisi(this.value);",'loadstart' => "changeVisi(this.value);" 	])?>
					</div>
						
					<div id="groupPanel" class="form-group col-md-6" >
						<?= $form->field($model, 'groupName')->textInput() ?>
					</div>
				</div>
				<div class='form-group'>
						<?= $form->field($model, 'privilegeId')->textInput() ?>
				</div>
				<div class="form-group">
					  <label >Default value</label>
				<?php
					function writeOption($value,$name){
						echo Html::beginTag('option',['value' => $value]);
						echo $name;
						echo Html::endTag('option');
					}
					 echo Html::beginTag('select',['name' => 'listPow','class' => 'form-control']);
			     		 writeOption("wr","Read-Write");
			    		 writeOption("r","Read");
			    		 writeOption("n","None");	
		     		 echo Html::endTag('select');
				?>
				</div>
                <div class="form-group row container">
                    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
                </div>
				<?php ActiveForm::end(); ?>
			</div>
	</div>
	</div>
</div>


