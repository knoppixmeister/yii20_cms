<?php
	defined('YII_APP') || die('Direct access to script denied!');

	$_langs = require __DIR__.'/languages.php';
	$languages = implode('|', array_keys($_langs));

	Yii::setAlias('user_modules', __DIR__.'/../../user_extensions/modules');

	$_configLanguage = 'en-US';
	foreach($_langs as $_lang_code => $_lang_vals) {
		if($_lang_vals['default']) {
			$_configLanguage = $_lang_vals['local'];
		}
	}

	$modules = [];
	if($dres = opendir(__DIR__."/../modules")) {
		while(false !== ($entry = readdir($dres))) {
			if($entry != '.' && $entry != ".." && is_dir(__DIR__."/../modules/".$entry)) {
				$modules[$entry] =	[
					'class'	=>	"app\\modules\\".$entry."\Module",
				];
			}
		}
	}

	if(file_exists(Yii::getAlias('@user_modules')) && $dres = opendir(Yii::getAlias('@user_modules'))) {
		while(false !== ($entry = readdir($dres))) {
			if($entry != '.' && $entry != ".." && is_dir(Yii::getAlias('@user_modules/'.$entry))) {
				$modules[$entry] =	[
					'class'	=>	"user_modules\\".$entry."\Module",
				];
			}
		}
	}

	$config = [
	    'id'			=>	'...-web-app',
	    'basePath'		=>	dirname(__DIR__),
	    'bootstrap'		=>	['log'],
	    'modules'		=>	$modules,
		'language'		=>	$_configLanguage,
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
				'class'					=>	'app\components\LangUrlManager',
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
    				'<language:('.$languages.')>/<module>/?'						=>	'<module>',
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
