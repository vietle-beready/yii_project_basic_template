<?php


$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'queue'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // 'log' => [
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
        'queue' => [
            'class' => '\yii\queue\db\Queue',
            'as log' => \yii\queue\LogBehavior::class,
            'db' => 'db', // DB connection component or its config 
            'tableName' => '{{%queue}}', // Table name
            'channel' => 'default', // Queue channel key
            'mutex' => \yii\mutex\MysqlMutex::class, // Mutex used to sync queries,
        ],
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    // configuration adjustments for 'dev' environment
    // requires version `2.1.21` of yii2-debug module
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
