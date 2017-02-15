<?php

namespace akim04\dish\models\common;

use akim04\dish\models\common\Ingredient;
use yii\db\ActiveQuery;

class IngredientQuery extends ActiveQuery
{
	/**
	 * @return $this
	 */
	public function active()
	{
		return $this->andWhere(['status' => Ingredient::STATUS_ACTIVE]);
	}

	public function hidden()
	{
		return $this->andWhere(['status' => Ingredient::STATUS_HIDDEN]);
	}
}