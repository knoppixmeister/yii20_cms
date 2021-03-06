<?php
	define('YII_APP', true);

	@set_time_limit(0);//no time limit
	//@date_default_timezone_set('Europe/...');

	defined('YII_DEBUG') or define('YII_DEBUG', true);

	//fcgi doesn't have STDIN and STDOUT defined by default
	defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
	defined('STDOUT') or define('STDOUT', fopen('php://stdout', 'w'));

	require __DIR__.'/vendor/autoload.php';
	require __DIR__.'/vendor/yiisoft/yii2/Yii.php';

	$config = require __DIR__.'/config/console.php';

	$application = new yii\console\Application($config);
	$exitCode = $application->run();
	exit($exitCode);