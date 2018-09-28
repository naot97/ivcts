<?php
namespace app\modules\employee;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Power;
use yii;
$this->title = '';
?>

<div class="card card-outline-info row">            
	<div class="card-body">
		<div class="form-body">
			<h4 class="card-header text-white">Create Employee</h4>
			<div class="p-t-20 container row">
				<?php
					$form = ActiveForm::begin([]); 
				?>
				<div class="form-group row container">
                    <?= $form->field($model, 'employeeName')->textInput() ?>
				</div>
				<div class="form-group row container">
                    <?= $form->field($model, 'employeeCode')->textInput() ?>
				</div>
					<div class="form-group row container">
                    <?= $form->field($model, 'mobile')->textInput() ?>
				</div>
					<div class="form-group row container">
                    <?= $form->field($model, 'email')->textInput() ?>
				</div>
				<div class="form-group row container">
                    <?= $form->field($model, 'currentAddress')->textInput() ?>
				</div>
				<div class = "form-group row container">
					<?= $form->field($model,'levelID')->dropDownList(ArrayHelper::map($levels, 'levelID', 'levelName'),[	])?>
				</div>
				<div class = "form-group row container">
					<?= $form->field($model,'sectionID')->dropDownList(ArrayHelper::map($sections, 'sectionID', 'sectionName'),[])?>
				</div>
				<div class = "form-group row container">
					<?= $form->field($model,'rank')->dropDownList(ArrayHelper::map($ranks, 'rankID', 'rankName'),[])?>
				</div>
				<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                                <?= $form->field($model, 'password')->passwordInput()?>
                                <?= $form->field($model, 'confirmPassword')->passwordInput()?>
                <div class="form-group">
                                <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
                                </div>
				<?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</div>  


