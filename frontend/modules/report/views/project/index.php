<?php

    $this->title = 'Report Project';
    
    $this->registerCssFile(Yii::$app->request->baseUrl.'/css/lib/datepicker/bootstrap-datepicker3.min.css', ['depends' => [\frontend\assets\MainAsset::className()]]);

    $this->registerCssFile(Yii::$app->request->baseUrl.'/css/lib/toastr/toastr.min.css', ['depends' => [\frontend\assets\MainAsset::className()]]);
    
    $this->registerCssFile(Yii::$app->request->baseUrl.'/css/lib/sweetalert/sweetalert.css', ['depends' => [\frontend\assets\MainAsset::className()]]);
    
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/datatables.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);       
    
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datepicker/bootstrap-datepicker.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);    
    
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/toastr/toastr.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);      
    
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/sweetalert/sweetalert.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);  
    
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/modules/common.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/angular/modules/report/project.js', ['depends' => [\frontend\assets\AngularAsset::className()]]);
?>
<div class="row" ng-controller="projectController" ng-init="init('<?=Yii::$app->request->baseUrl?>');">
    <div class="col-12">
        <div class="card card-outline-info">            
            <div class="card-body">                     
           			<?= $this->render('info') ?>
           			<?= $this->render('list') ?>
            </div>
        </div>
    </div>    
</div>
