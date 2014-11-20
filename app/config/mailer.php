<?php
	defined('YII_APP') || die('Direct acceess to script denied!');

	return 	[
				'class' 				=>	'yii\swiftmailer\Mailer',
				//'viewPath' 			=>	'@app/mail',
				//'useFileTransport' 	=>	true,
				'transport' =>	[
									'class'			=>	'Swift_SmtpTransport',
									'host' 			=>	'',//smtp.server.com
									//'username'	=>	'',
									//'password'	=>	'',
									'port'			=>	'25',//465
									//'encryption'	=>	'tls',//ssl
								],
			];