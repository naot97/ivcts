<?php
use yii\web\Request;
$request = new Request();
$baseURL = str_replace('/frontend/web', '', $request->baseUrl);
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'common' => [
            'class' => 'app\modules\common\Common',
        ],
        'login' => [
            'class' => 'app\modules\login\Login',
        ],
        'dashboard' => [
            'class' => 'app\modules\dashboard\Dashboard',
        ],
        'resource' => [
            'class' => 'app\modules\resource\Resource',
        ],
        'project' => [
            'class' => 'app\modules\project\Project',
        ],
        'employee' => [
            'class' => 'app\modules\employee\Employee',
        ],
        'report' => [
            'class' => 'app\modules\report\Report',
        ],
        'suggestion' => [
            'class' => 'app\modules\suggestion\Suggestion',
        ],
        'simulation' => [
            'class' => 'app\modules\simulation\Simulation',
        ],
        
        'register' => [
            'class' => 'app\modules\register\Register',
        ],

    ],
    'components' => [
        'request' => [
            'csrfParam' => 'ivcts-frontend',
            'baseURL' => $baseURL,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'application/json; charset=UTF-8' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\Employee',
            'enableAutoLogin' => false,
            'loginUrl' => null,
//            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
