<?php
	use yii\helpers\Html;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\widgets\Breadcrumbs;
	use app\assets\AppAsset;
	use app\helpers\Url;

	AppAsset::register($this);

	$this->beginPage();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="<?php echo Yii::$app->charset?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <?php echo Html::csrfMetaTags()?>
	<title><?php echo Html::encode($this->title)?></title>

	<?php $this->head()?>
</head>
<body>
	<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
						'brandLabel'	=>	'Awesome web site',
						'brandUrl'		=>	\Yii::$app->homeUrl,
						'options'		=>	['class' => 'navbar-default navbar-fixed-top'],
            		]);
            echo Nav::widget([
                'options'	=>	['class' => 'navbar-nav'],
                'items' 	=>	[
                					Yii::$app->user->isGuest ?
									['label' => 'Home', 'url' => ['/']] :
                					[
                						'label'	=>	'Dashboard',
                						'url'	=>	['/dashboard'],
            						],
			               		],
           	]);
            echo Nav::widget([
	            		'options'	=>	['class' => 'navbar-nav navbar-right'],
	            		'items' 	=>	[
				            				Yii::$app->user->isGuest ?
				            				['label' => 'Login', 'url' => ['/ru/login']] :
				            				[
				            					'label'	=>	'Logout ('.\Yii::$app->user->identity->username.')',
				            					'url'	=>	['/ru/logout'],
				            				],
	            							['label' => 'Register', 'url' => ['/ru/register']],
	            						],
            ]);
			NavBar::end();
        ?>

		<div class="container">
            <?php echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>
            <?php echo $content?>
		</div>

    </div>

	<?php
		$ip = $_SERVER['REMOTE_ADDR'];
		if(!in_array($ip, array('::1', '127.0.0.1'))) {
	?>

	<?php
		}
	?>

	<!-- YOUR IP: <?php echo $ip?> -->

	<?php $this->endBody()?>
</body>
</html>
<?php
	$this->endPage();