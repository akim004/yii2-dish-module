<?php

namespace akim04\dish\models\common;

use akim04\dish\models\common\Dish;
use yii\db\ActiveQuery;

class DishQuery extends ActiveQuery
{
	/**
	 * @return $this
	 */
	public function active()
	{
		return $this->andWhere(['status' => Dish::STATUS_ACTIVE]);
	}

	public function hidden()
	{
		return $this->andWhere(['status' => Dish::STATUS_HIDDEN]);
	}
}