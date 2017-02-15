<?php

namespace akim04\dish\models\backend;

use Yii;
use akim04\dish\Module;
use yii\helpers\ArrayHelper;

class Ingredient extends \akim04\dish\models\common\Ingredient
{
	const SCENARIO_ADMIN_CREATE = 'adminCreate';
	const SCENARIO_ADMIN_UPDATE = 'adminUpdate';

	public function rules()
	{
		return ArrayHelper::merge(parent::rules(), [
		]);
	}

	public function scenarios()
	{
		return ArrayHelper::merge(parent::scenarios(), [
			self::SCENARIO_ADMIN_CREATE => ['name', 'status'],
			self::SCENARIO_ADMIN_UPDATE => ['name', 'status'],
		]);
	}

	public static function getIngredientById($id)
	{
		$ingredient = self::find()->where(['id' => $id])->one();

		return $ingredient;
	}
}
