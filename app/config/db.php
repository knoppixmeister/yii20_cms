<?php
	defined('YII_APP') || die('Direct access to script denied!');

	return	[
				'class'		=>	'yii\db\Connection',
				'dsn'		=>	'mysql:host=localhost;port=3306;dbname=...',
				'username'	=>	'',
				'password'	=>	'',
				'charset'	=>	'utf8',

				//'enableQueryCache'	=>	true,
				'enableSchemaCache'		=>	true,
				'queryCacheDuration'	=>	10*60,//10 min.
			];