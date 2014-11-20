<?php
	namespace app\modules\test\controllers;

	defined('YII_APP') || die('Direct access to script denied!');

	class DefaultController extends \yii\web\Controller {
		public function actionIndex() {
			$this->layout = 'test_main';
			return $this->render('index', []);
		}
	}