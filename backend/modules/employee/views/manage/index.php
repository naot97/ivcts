<?php
namespace app\modules\employee\views\manage;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii;
?>  
<script type="text/javascript">
    function abcxyz(value){
        alert(value);
    }
</script>
<style type="text/css">
    .custom {
color: coral;}
</style>
<div class="card card-outline-info">
<div class="card-body">
	<div class="body-form">
		<h4 class="card-header text-white ">Manager</h4>
		<?php $form = ActiveForm::begin([]);  ?>
		<?= GridView::widget([
    	'dataProvider' => $data,
    	'columns' => [
	        ['class' => 'yii\grid\SerialColumn'],
	        'employeeID',
	        'employeeName',
	         [
            'attribute'=>'username',
            'label'=>'username',
            'format'=>'text',
            'content'=>function($data){
                return $data->getUsername();
            	}
       		 ],
       		 [
            'attribute'=>'sectionID',
            'label'=>'section',
            'format'=>'text',
            'content'=>function($data){
                return $data->getSectionName();
            	}
       		 ],
       		 [
            'attribute'=>'levelID',
            'label'=>'level',
            'format'=>'text',
            'content'=>function($data){
                return $data->getLevelName();
            	}
       		 ],
       		 [
            'attribute'=>'rank',
            'label'=>'rank',
            'format'=>'text',
            'content'=>function($data){
                return $data->getRankName();
            	}
       		 ],
	        'employeeCode',
	        'mobile',
	        'currentAddress',
        	[
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}',
            'buttons' => [
                'delete' => function ($url,$model) {
                	 return Html::a('<span class="text-danger"> Delete <span> ', $url, [
                            'title' => Yii::t('app', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                            'data-method' => 'post', 'data-pjax' => '0',
                ]);
                },
                'update' => function ($url,$model) {
                    return Html::a('
                        <span class="text-primary"> Update <span>',$url,
                        ['data-method' => 'post', 'data-pjax' => '0']);
                },
	        ],
        	],
        ],
        'layout'=>"{items}\n{pager}",
        'showOnEmpty'=>true,
      	'tableOptions' =>[
        	'class' => 'custom display nowrap table table-hover table-bordered ', 
        	'cellspacing' => '0',
        	'width' => '100%',
            ]
		]);?>
		<?php ActiveForm::end();
 ?>
	</div>

</div>
</div>
