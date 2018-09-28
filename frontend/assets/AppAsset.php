<?php

namespace frontend\assets;

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
        'frontend\assets\MainAsset',
        'frontend\assets\AngularAsset',
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
