<?php

    $this->title = 'Register';
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">    
    <head>
        <title>Login</title>
        <meta charset="<?= Yii::$app->charset ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::$app->request->baseUrl ?>/images/favicon.png">        
	<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/css/lib/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/css/helper.css" />
        <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl ?>/css/style.css" />
    </head>
    <body id="bd-login" class="fix-header fix-sidebar">
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
            </svg>
        </div>
        
        <div id="main-wrapper">
            <div class="unix-login">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="login-content card">
                                <div class="login-form" >
                                    <h4>Register</h4>
                                    <?php 
                        use yii\helpers\Html;
                        use yii\bootstrap\ActiveForm;

                        $form = ActiveForm::begin([]); 
                        ?>
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                                <?= $form->field($model, 'password')->passwordInput()?>
                                <?= $form->field($model, 'confirmPassword')->passwordInput()?>
                                <?= $form->field($model, 'employeeId')->textInput(['autofocus' => true]) ?>
                                <div class="form-group">
                                    <div class="col-lg-offset-1 col-lg-11">
                                        <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                                    </div>
                                </div>

                        <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="<?= Yii::$app->request->baseUrl ?>/js/lib/jquery/jquery.min.js"></script>  
        <script src="<?= Yii::$app->request->baseUrl ?>/js/lib/bootstrap/js/popper.min.js"></script> 
        <script src="<?= Yii::$app->request->baseUrl ?>/js/lib/bootstrap/js/bootstrap.min.js"></script> 
        <script src="<?= Yii::$app->request->baseUrl ?>/js/jquery.slimscroll.js"></script> 
        <script src="<?= Yii::$app->request->baseUrl ?>/js/sidebarmenu.js"></script> 
        <script src="<?= Yii::$app->request->baseUrl ?>/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script> 
        <script src="<?= Yii::$app->request->baseUrl ?>/js/custom.min.js"></script> 
    </body>

</html>


    

