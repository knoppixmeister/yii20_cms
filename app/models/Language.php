<?php
	namespace app\models;

	defined('YII_APP') || die('Direct access to script denied!');

	class Language extends \yii\db\ActiveRecord {
		public static function tableName() {
			return 'languages';
		}
	}