<?php
	namespace app\components;

	defined('YII_APP') || die('Direct access to script denied!');

	class LangUrlManager extends \yii\web\UrlManager {
		public function createUrl($params) {

			return parent::createUrl($params);
		}
	}