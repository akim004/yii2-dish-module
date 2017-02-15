<?php

namespace akim04\dish;

use Yii;

class Module extends \yii\base\Module
{

	public $controllerNamespace = 'akim04\dish\controllers';

	public function init()
	{
		parent::init();
	}

	public static function t($category, $message, $params = [], $language = null)
	{
		return Yii::t('modules/dish/' . $category, $message, $params, $language);
	}
}
