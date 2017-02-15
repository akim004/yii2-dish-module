<?php

namespace akim04\dish;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
	public function bootstrap($app)
	{
		$app->i18n->translations['modules/dish/*'] = [
			'class' => 'yii\i18n\PhpMessageSource',
			'forceTranslation' => true,
			'basePath' => __DIR__.'/messages',
			'fileMap' => [
				'modules/dish/module' => 'module.php',
			],
		];

		\Yii::setAlias('@akim04', dirname(__DIR__));

		$app->urlmanager->addRules($this->getUrlRules(), false);
	}

	/**
	 * Возвращает список правил роутинга.
	 *
	 * @return array
	 */
	public function getUrlRules()
	{
		return [
			'admin/dish/<_controller:[\w\-]+>/<_action:[\w\-]+>/<id:\d+>' => 'dish/backend/<_controller>/<_action>',
			'admin/dish/<_controller:[\w\-]+>/<id:\d+>' => 'dish/backend/<_controller>/view',
			'admin/dish/<_controller:[\w\-]+>' => 'dish/backend/<_controller>/index',
			'admin/dish' => 'dish/backend/default/index',

			'dish/<_controller:[\w\-]+>/<_action:[\w\-]+>/<id:\d+>' => 'dish/frontend/<_controller>/<_action>',
			'dish/<_controller:[\w\-]+>/<id:\d+>' => 'dish/frontend/<_controller>/view',
			'dish/<_controller:[\w\-]+>' => 'dish/frontend/<_controller>/index',
			'dish' => 'dish/frontend/default/index',

		];
	}
}