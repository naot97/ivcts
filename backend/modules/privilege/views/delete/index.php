<?php
namespace app\modules\privilege;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Power;
use yii;
$this->title = '';
?>

<div class="card card-outline-info">       
		<div class="card-body">
		<div class="form-body">
		<h4 class="card-header text-white ">Delete Privilege</h4>
			<div class='p-t-20 '>
				<?php
						$form = ActiveForm::begin([]); 
					?>
					
						<?= $form->field($model,'privilegeId')->dropDownList(ArrayHelper::map($privileges, 'privilegeId', 'name'))?>
						
	                <div class="form-group ">
	                    <?= Html::submitButton('Delete', ['class' => 'btn btn-primary', 'name' => 'delete-pri-button']) ?>
	                </div>
					<?php ActiveForm::end(); ?>
			</div>
		</div>
		<div class="form-body">
		<h4 class="card-header text-white">Delete Group</h4>
			<div class='p-t-20 '>
					<?php
						$form = ActiveForm::begin([]); 
					?>
					<div class="form-group ">
						<?= $form->field($model,'groupId')->dropDownList(ArrayHelper::map($groups, 'groupId', 'name'))?>
					</div>
	                <div class="form-group ">
	                    <?= Html::submitButton('Delete', ['class' => 'btn btn-primary', 'name' => 'delete-group-button']) ?>
	                </div>
					<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>

</div>


