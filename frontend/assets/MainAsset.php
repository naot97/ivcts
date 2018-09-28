<?php
namespace frontend\assets;

use yii\web\View;
use yii\web\AssetBundle;

class MainAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        ['css/lib/chartist/chartist.min.css', 'rel' => 'stylesheet'],
        ['css/lib/owl.carousel.min.css', 'rel' => 'stylesheet'],
        ['css/lib/owl.theme.default.min.css', 'rel' => 'stylesheet'],
        ['css/lib/bootstrap/bootstrap.min.css', 'rel' => 'stylesheet'],
        ['css/helper.css', 'rel' => 'stylesheet'],
        ['css/style.css', 'rel' => 'stylesheet'],
        ['css/mystyle.css', 'rel' => 'stylesheet'],
    ];
    public $js = [
        'js/lib/jquery/jquery.min.js',
        'js/lib/bootstrap/js/popper.min.js',
        'js/lib/bootstrap/js/bootstrap.min.js',
        'js/jquery.slimscroll.js',
        'js/sidebarmenu.js',
        'js/lib/sticky-kit-master/dist/sticky-kit.min.js',
        'js/custom.min.js',
    ];
}
