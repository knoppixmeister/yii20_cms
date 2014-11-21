<?php
	namespace app\components;

	defined('YII_APP') || die('Direct access to script denied!');

	class AppController extends \yii\web\Controller {
		public $meta_keywords		=	"";
		public $meta_description	=	"";

		public function init() {
			parent::init();

			if(!empty($_GET['language'])) {
				\Yii::$app->params['_sys']['language'] = $_GET['language'];
				//Yii::app()->user->setState('language', $_GET['language']);
				$cookie = new \yii\web\Cookie();
				$cookie->name = 'language';
				$cookie->value = $_GET['language'];
				$cookie->expire = time()+(60*60*24*365); // (1 year)
				\Yii::$app->getResponse()->getCookies()->add($cookie);
			}
			elseif(\Yii::$app->getRequest()->getCookies()->has('language')) {
				\Yii::$app->params['_sys']['language'] = \Yii::$app->getRequest()->getCookies()->get('language');
			}
		}
	}