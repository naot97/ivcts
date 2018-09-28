<?php
namespace backend\assets;

use yii\web\View;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
    public $jsOptions = [
        'position' => View::POS_END,
    ];
    public $depends = [
        'backend\assets\MainAsset',
        'backend\assets\AngularAsset',
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
