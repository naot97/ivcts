<?php
  $this->title = 'Period';
    
   $this->registerCssFile(Yii::$app->request->baseUrl.'/css/lib/datepicker/bootstrap-datepicker3.min.css', ['depends' => [\backend\assets\MainAsset::className()]]);

    $this->registerCssFile(Yii::$app->request->baseUrl.'/css/lib/toastr/toastr.min.css', ['depends' => [\backend\assets\MainAsset::className()]]);
    
    $this->registerCssFile(Yii::$app->request->baseUrl.'/css/lib/sweetalert/sweetalert.css', ['depends' => [\backend\assets\MainAsset::className()]]);
    
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/datatables.min.js', ['depends' => [\backend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js', ['depends' => [\backend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js', ['depends' => [\backend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js', ['depends' => [\backend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js', ['depends' => [\backend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js', ['depends' => [\backend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js', ['depends' => [\backend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js', ['depends' => [\backend\assets\MainAsset::className()]]);       
    
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/datepicker/bootstrap-datepicker.min.js', ['depends' => [\backend\assets\MainAsset::className()]]);    
    
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/toastr/toastr.min.js', ['depends' => [\backend\assets\MainAsset::className()]]);      
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lib/sweetalert/sweetalert.min.js', ['depends' => [\backend\assets\MainAsset::className()]]);       
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/modules/privilege/default.js', ['depends' => [\backend\assets\MainAsset::className()]]);
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/angular/modules/period/default.js', ['depends' => [\backend\assets\AngularAsset::className()]]);
?>
<div class="row">
	<div class="card card-outline-info col-md-12" ng-controller="periodController" ng-init="init('<?=Yii::$app->request->baseUrl?>');">     
		<div class="card-body ">
			<?php echo $this->render('info')?>
			<?php echo $this->render('list')?>
		</div>
	</div>
</div>