<?php
	namespace app\components;

	defined('YII_APP') || die('Direct access to script denied!');

	class LangUrlManager extends \yii\web\UrlManager {
		public $useUrlLanguage = true;
		public $source = 'php';//or 'db'

		public function createUrl($params) {
			$params = (array)$params;
			$params[0] = '/ru/'.$params[0];

			//echo '[aaa: '.implode(',', $params)."]&nbsp;";

			$url = parent::createUrl($params);

			//echo '[res_url: '.$url.']';

			return $url;
		}

		public function validateLangCode($code) {

			return true;
		}

		public function getDefLang() {

			return 'ru';
		}

		public function getCurrentLang() {

			return [];
		}
	}