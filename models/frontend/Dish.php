<?php

namespace akim04\dish\models\frontend;

use Yii;
use akim04\dish\Module;
use yii\helpers\ArrayHelper;

class Dish extends \akim04\dish\models\common\Dish
{
	public $ingredientIds;

	public $ingredient_count;

	public function attributeLabels()
	{
		return ArrayHelper::merge(parent::attributeLabels(), [
			'ingredient_count' => 'Количество совпавших ингредиентов',
		]);
	}
}
