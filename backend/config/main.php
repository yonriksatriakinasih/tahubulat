<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],           
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
//            'loginUrl' => ['site/login'],  
//            'enableSession' =>  true,
            'identityCookie' => [ // check login status if run apps from other browser
                'name' => '_backendUser', // unique for backend
                'path' => '/advanced/backend/web' // correct path for backend app.
            ]
        ],
//        'session' => [
//            'name' => '_backendSessionId',
//            'savePath' => __DIR__ . '/../runtime',  
//        ],
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
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-green',
                ],
            ],
        ],
        'cv'=>[
            'class' => 'backend\components\Cv'
        ],
//		'view' => [
//			 'theme' => [
//				 'pathMap' => [
//					'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
//				 ],
//			 ],
//		],
        'db'    =>  [
            'class' => '\yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=lp3i_cv',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'wrk_',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
    'timeZone' => 'Asia/Jakarta',
    'language' => 'id',
];
