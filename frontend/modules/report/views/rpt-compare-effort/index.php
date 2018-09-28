<?php
    $this->title = 'Compare Effort';
    
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/datatables.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js', ['depends' => [\frontend\assets\MainAsset::className()]]);  
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/modules/report/rpt-compare-effort.js', ['depends' => [\frontend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/angular/modules/report/rpt-compare-effort-controllers.js', ['depends' => [\frontend\assets\AngularAsset::className()]]);
    
?>

<div class="row" ng-controller="rptCompareEffortController" ng-init="init('<?=Yii::$app->request->baseUrl?>');">
    <div class="col-12">
        <div class="card card-outline-info">            
            <div class="card-body">          
                <?php echo $this->render('partials/input-search'); ?>
                <?php echo $this->render('partials/grid-report'); ?>
            </div>
        </div> 
    </div>    
</div>

