<?php
	define('YII_APP', true);

	@ini_set("display_errors", "0");
	//@date_default_timezone_set('Europe/...');

	$ip = $_SERVER['REMOTE_ADDR'];
	if(!defined('YII_DEBUG')) {
		if(in_array($ip, ['::1', '127.0.0.1'])) define('YII_DEBUG', true);
		else define('YII_DEBUG', false);
	}
	if(!defined('YII_ENV')) {
		if(in_array($ip, ['::1', '127.0.0.1'])) define('YII_ENV', 'dev');
		else define('YII_ENV', 'prod');//dev
	}

	if(!defined('YII_DEBUG') || !YII_DEBUG) {
		@ini_set("display_errors", "0");
	}

	ob_start(function($b) {
		return preg_replace(['/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s'], ['>', '<', '\\1'], $b);
	});

	require __DIR__.'/app/vendor/autoload.php';
	require __DIR__.'/app/vendor/yiisoft/yii2/Yii.php';

	$config = require __DIR__.'/app/config/web.php';

	(new yii\web\Application($config))->run();
