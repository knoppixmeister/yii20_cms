yii20_cms
=========

CMS (content management system) based on Yii 2.0

Install process

1)
2)
...

- Do't forget to update composer.phar -> php composer.phar self-update
- Update vendor's code -> php composer.phar update
- If there is "Call to undefined method yii\helpers\Html::csrfMetaTags()" error check this

https://github.com/yiisoft/yii2/issues/5060#issuecomment-55859283

	1. php composer.phar global require "fxp/composer-asset-plugin:1.0.*@dev"
	2. php composer.phar update --dev (requires github account)
