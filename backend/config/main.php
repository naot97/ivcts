<?php
use yii\web\Request;
$request = new Request();

$baseURL = str_replace('/web', '', $request->baseUrl);
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'login' => [
            'class' => 'app\modules\login\Login',
        ],
        'admin' =>[
            'class' => 'app\modules\admin\Admin',
        ],
        'privilege' => [
            'class' => 'app\modules\privilege\Privilege',
        ],
        'employee' =>[
            'class' => 'app\modules\employee\Employee',
        ],
        'dashboard' =>[
            'class' => 'app\modules\dashboard\Dashboard',
        ],
        'period' =>[
            'class' => 'app\modules\period\Period',
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseURL' => $baseURL,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'application/json; charset=UTF-8' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\Employee',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
       'urlManager' => [
            'baseURL' => $baseURL,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
    'defaultRoute' => 'login',
];
