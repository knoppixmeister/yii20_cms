<?php
	defined('YII_APP') || die('Direct access to script denied!');

	//Yii::setAlias('@tests', dirname(__DIR__).'/tests');

	return [
		'id'					=>	'...-console-app',
		'basePath'				=>	dirname(__DIR__),
		'bootstrap'				=>	['log'],
		//'controllerNamespace'	=>	'app\commands',
		//'modules' 			=>	[],
		//'vendorPath'			=>	__DIR__.'/../../../app/vendor',
		'language'				=>	'en-US',
		'components' =>	[
			/*
			'authManager' => [
				'class'				=>	'yii\rbac\DbManager',
				//'defaultRoles'	=>	['admin', 'author'],
			],
			/*
			'cache'	=>	[
				'class' => 'yii\caching\FileCache',
			],
			*/
			'log'	=>	[
			            	'targets'	=>	[
								                [
								                    'class'		=>	'yii\log\FileTarget',
								                    'levels'	=>	['error', 'warning'],
								                ],
			            					],
						],
	        'db'		=>	require __DIR__.'/db.php',
	        'mailer'	=>	require __DIR__.'/mailer.php',
		],
		'params'	=>	require __DIR__.'/params.php',
	];