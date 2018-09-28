<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <title>IVC TS</title>
        <meta charset="<?= Yii::$app->charset ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/png" sizes="16x16" href="<?= Yii::$app->request->baseUrl ?>/images/favicon.png">

        <?= Html::csrfMetaTags() ?>
        <?php $this->head(); ?>
    </head>
    <style type="text/css">
       
    </style>
    <body id="bd-main" class="fix-header fix-sidebar">
        <?php $this->beginBody(); ?>
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
            </svg>
        </div>
        
        <div id="main-wrapper">        
            <?php echo $this->render('partials/header'); ?>
            
            <?php echo $this->render('partials/sideBar'); ?>
            
            <div class="page-wrapper">                
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-primary"><?= Html::encode($this->title) ?></h3> 
                    </div>
                </div>
                
                <div class="container-fluid" ng-app="myAngular">
                    <?= $content ?>
                </div>

                <?php echo $this->render('partials/footer'); ?>
            </div>
        </div>
        <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>