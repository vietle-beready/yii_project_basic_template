<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'UaBspqxza96xuVONTxX8icaCZNYI-cyv',
            'parsers' => [
                'application/json' => yii\web\JsonParser::class,
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\symfonymailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'dsn' => "smtps://{$_ENV['SMTP_USERNAME']}:{$_ENV['SMTP_PASSWORD']}@smtp.gmail.com:465",
                'options' => [
                    'verify_peer' => 0,
                    'verify_peer_name' => 0,
                ],
            ],
        ],
        // 'log' => [
        //     'traceLevel' => YII_DEBUG ? 3 : 0,
        //     'targets' => [
        //         [
        //             'class' => 'yii\log\FileTarget',
        //             'levels' => ['info', 'error', 'warning', 'trace'],
        //             'logFile' => '@runtime/logs/queue.log',
        //             'categories' => ['yii\queue\Queue', 'queue'],
        //             'logVars' => [],
        //         ],
        //     ],
        // ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'error', 'warning', 'trace'],
                    'logFile' => '@runtime/logs/queue.log',
                    'categories' => ['yii\queue\Queue', 'queue'],
                    'logVars' => [],
                ],

                [
                    'class' => 'yii\log\FileTarget',
                    'enabled' => true,
                    'categories' => ['api', 'cron', 'yii\queue\Queue', 'queue', 'collection', 'firewall'],
                    'levels' => ['error', 'warning', 'trace'],
                    'enableRotation' => true,
                    'logFile' => '@runtime/logs/queue.log',
                    'logVars' => [],
                ],

                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'trace'],
                    'logVars' => [],
                    'logFile' => '@runtime/logs/commands.log',
                    'enabled' => true,
                ]
            ],
        ],
        'db' => $db,
        'queue' => [
            'class' => '\yii\queue\db\Queue',
            'db' => 'db', // DB connection component or its config 
            'tableName' => '{{%queue}}', // Table name
            'channel' => 'default', // Queue channel key
            'mutex' => \yii\mutex\MysqlMutex::class, // Mutex used to sync queries,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'lien-he.html' => 'site/contact', // Replace 'site/contact' with your actual controller/action

            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'panels' => [
            'queue' => \yii\queue\debug\Panel::class,
        ],
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
