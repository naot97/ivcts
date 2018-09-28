<?php
namespace app\modules\employee\manage;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii;
?>
<div class="card card-outline-info row">            
	<div class="card-body">
		<div class="form-body">
			<h4 class="card-header text-white">Change Employee</h4>
			<div class="p-t-20 	">
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
                 <?= $form->field($model, 'confirmPassword')->passwordInput()->label("Confirm Password ( If dont't want change password, please don't type anything in this box.)")?>
                <div class="form-group">
                                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
                                </div>
				<?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</div>  
