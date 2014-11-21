<?php
	defined('YII_APP') || die('Direct access to script denied!');

	use yii\db\Schema;

	class m141121_131820_db_languages extends \yii\db\Migration {
		public function up() {
			$tableOptions = null;

			if($this->db->driverName === 'mysql') {
				$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
			}

			$this->createTable('{{%languages}}',	[
														'id' => Schema::TYPE_PK,
														'url' => Schema::TYPE_STRING.'(255) NOT NULL',
														'local' => Schema::TYPE_STRING.'(255) NOT NULL',
														'name' => Schema::TYPE_STRING.'(255) NOT NULL',
														'default' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
													], $tableOptions);

			$this->batchInsert(
						'lang',
						['url', 'local', 'name', 'default'],
						[
							['en', 'en-EN', 'English', 0],
							['ru', 'ru-RU', 'Русский', 1],
						]
					);
		}

		public function down() {
			$this->dropTable('{{%languages}}');

			return true;
		}
	}