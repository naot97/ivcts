<?php
namespace frontend\assets;

use yii\web\View;
use yii\web\AssetBundle;

class AngularAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        ['js/angular/dist/css/angular-datatables.css', 'rel' => 'stylesheet'],
    ];
    public $js = [
        'js/angular/angular.js',
        'js/angular/angular-route.js',
        'js/angular/angular-sanitize.js',
        'js/angular/dist/angular-datatables.js',
        'js/angular/app.js',
        'js/angular/modules/common.js',
    ];
}
