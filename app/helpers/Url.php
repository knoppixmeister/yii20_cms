<?php
	namespace app\helpers;

	defined('YII_APP') || die('Direct access to script denied!');

	class Url extends \yii\helpers\Url {
		public static function to($url='', $full_url=false, $no_lang=false, $lang=null) {
			$url = (array)$url;

			return parent::to($url, $full_url);
		}
	}