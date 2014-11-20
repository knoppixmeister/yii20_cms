<?php
	defined('YII_APP') || die('Direct access to script denied!');

	$languages = 'ru|en';

	$modules = [];
	if($dres = opendir(__DIR__."/../modules")) {
		while(false !== ($entry = readdir($dres))) {
			if($entry != '.' && $entry != ".." && is_dir(__DIR__."/../modules/".$entry)) {
				$modules[$entry] =	[
					'class'	=>	"app\modules\\".$entry."\Module",
				];
			}
		}
	}

	/*
	if(is_dir(Yii::getPathOfAlias('user_modules'))) {
		if($dres = opendir(Yii::getPathOfAlias('user_modules'))) {
			while(false !== ($entry = readdir($dres))) {
				if($entry != '.' && $entry != ".." && is_dir(Yii::getPathOfAlias('user_modules')."/".$entry)) {
					$modules[$entry] =	array(
							'class'	=> 'user_modules.'.$entry.".".ucfirst($entry)."Module",
					);
				}
			}
		}
	}
	*/

	$config = [
	    'id'			=>	'...-web-app',
	    'basePath'		=>	dirname(__DIR__),
	    'bootstrap'		=>	['log'],
	    'modules'		=>	$modules,
		'language'		=>	'en-US',
		//'vendorPath'	=>	__DIR__.'/../../../app/vendor',
		//'defaultRoute'	=>	'site/index',
	    'components'	=>	[
	    	'db'			=>	require __DIR__.'/db.php',
	    	/*
			'authManager'	=>	[
				'class' => 'yii\rbac\DbManager',
				//'defaultRoles' => ['admin', 'author'],
			],
			*/
			'urlManager'	=>	[
				'enablePrettyUrl'		=>	true,
				'showScriptName'		=>	false,
				'enableStrictParsing'	=>	true,
				'rules'				=>	[
					'http://www.server.com' 										=>	'site',
					'http://www.server.com/sitemap.xml'								=>	'sitemap',

					'http://<subdomain:([a-z0-9-_]+)>.server.com'					=>	'site',
					'http://<subdomain:([a-z0-9-_]+)>.server.com/<action>/?'		=>	'sub/<action>',
					'http://<subdomain:([a-z0-9-_]+)>.server.com/<action>/<id:\d+>'	=>	'sub/<action>',

					'<language:('.$languages.')>/<action:(login|logout|contact|register)>'	=>	'site/<action>',

    				'<language:('.$languages.')>/<controller>/<action>/<id:\d+>'	=>	'module/<controller>/<action>',
    				'<language:('.$languages.')>/<controller>/<action>'				=>	'module/<controller>/<action>',
    				'<language:('.$languages.')>/<module>'							=>	'<module>',
    				'<language:('.$languages.')>/?'									=>	'site/home',
					'/'																=>	'site',

					'sitemap.xml'													=>	'sitemap',
				],
			],
			'request' => [
				// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
				'cookieValidationKey' => '',
			],
	        /*
			'cache' => [
				'class' => 'yii\caching\FileCache',
			],
			*/
			'user' => [
	            'identityClass'		=>	'app\models\User',
	            'enableAutoLogin'	=>	true,
	            'loginUrl'			=>	['/login'],
			],
			'errorHandler'	=>	[
				'errorAction' => 'site/error',
			],
			'mailer'	=>	require __DIR__.'/mailer.php',
			'log'		=>	[
					            'traceLevel'	=>	YII_DEBUG ? 3 : 0,
					            'targets'		=>	[
														[
															'class'		=>	'yii\log\FileTarget',
															'levels'	=>	['error', 'warning'],
														],
													],
							],
		],
		'params'	=>	require __DIR__.'/params.php', 
	];
	/*
	if(YII_ENV_DEV) {
	    // configuration adjustments for 'dev' environment
	    $config['bootstrap'][]		=	'debug';
	    $config['modules']['debug']	=	'yii\debug\Module';
	}
	*/
	return $config;
