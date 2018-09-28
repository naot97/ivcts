<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/layout.css');

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
        *{
            font-size: 14px;
            margin: 0px;
        }
        .btn{
            width: 90px;
            height: 30px;
        }  
        label{
            font-weight: 1px; 
            padding: 0px;
            margin: 0px;
        }
        .card-header{
            font-size: 15px;
            padding: 0px;
            margin: 0px;
        }
        .table thead tr th {
            text-align: center;
            font-weight: bold;
            line-height: 1.2;
        }
        .table tbody tr {
            cursor: pointer;
        }
        .table tbody tr td {
            text-align: left;
            padding: 0px 5px 0px 5px;
            width: 5%;
            line-height: 1.2;
        }
        .table tbody tr td a{
            color: #4680ff;
        }
        .table tbody tr .index{
            width: 1% !important;
        }
        .container-fluid{
            margin: 0px;
            padding: 0px;
        }
        .card-body{
            padding: 0px;
            margin: 0px;
        }
        .page-titles{
            line-height: 0.5;
            padding: 0px;
            margin: 0px;
            font-size: 15px;    
        }
        .card{
            margin: 1px 5px 1px 5px;
            padding: 10px 20px 10px 20px;
        }
        .card-header{
            margin: 0px;
            padding: 0px;
        }
        .form-group{
            padding: 0px; 
            margin: 0px;
        }
        .form-control,select:not([size]):not([multiple]).form-control
        {
            margin: 0px;
            padding: 0px;
            height: 30px;
        }
        .row{
            margin: 0px;
            padding: 0px;
        }
        .form-control:focus,.radio:focus{
            outline: none !important;
            border-color: #1E90FF;
        }
        table.dataTable, table.dataTable.no-footer{
            margin: 5px 0;
        }
        .dataTables_wrapper{
            padding: 0;
        }

    </style>
    <body id="bd-main" class="fix-header fix-sidebar">
          
        <?php $this->beginBody(); ?>
        <div class="preloader">
            
        </div>
        
        <div id="main-wrapper">        
            <?php echo $this->render('partials/header'); ?>
            <?php echo $this->render('partials/sideBar'); ?>
            <div class="page-wrapper">                
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-primary"><?= Html::encode($this->title) ?></h4> 
                    </div>
                </div>
                <div class="container-fluid" ng-app="myAngular" >
                    <?= $content ?>
                </div>
                <?php echo $this->render('partials/footer'); ?>
            </div>
        </div>
        <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>