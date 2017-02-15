<?php

namespace akim04\dish\models\backend;

use Yii;
use akim04\dish\Module;
use cornernote\linkall\LinkAllBehavior;
use yii\helpers\ArrayHelper;

class Dish extends \akim04\dish\models\common\Dish
{
	const SCENARIO_ADMIN_CREATE = 'adminCreate';
	const SCENARIO_ADMIN_UPDATE = 'adminUpdate';

	public $ingredientIds;

	public function rules()
	{
		return ArrayHelper::merge(parent::rules(), [
			[['ingredientIds'], 'safe'],
		]);
	}

	public function behaviors()
	{
		return ArrayHelper::merge(parent::behaviors(), [
			['class' => LinkAllBehavior::className()],
		]);
	}


	public function scenarios()
	{
		return ArrayHelper::merge(parent::scenarios(), [
			self::SCENARIO_ADMIN_CREATE => ['name', 'status', 'ingredientIds'],
			self::SCENARIO_ADMIN_UPDATE => ['name', 'status', 'ingredientIds'],
		]);
	}

	public function attributeLabels()
	{
		return ArrayHelper::merge(parent::attributeLabels(), [
			'ingredientIds' => 'Ингредиенты',
		]);
	}

	public function afterSave($insert, $changedAttributes)
	{
		$ingredients = [];

		if($this->ingredientIds){
			foreach ($this->ingredientIds as $ingredientId) {
				$ingredient = Ingredient::getIngredientById($ingredientId);
				if ($ingredient) {
					$ingredients[] = $ingredient;
				}
			}
		}
		$this->linkAll('ingredients', $ingredients);

		parent::afterSave($insert, $changedAttributes);
	}

}
