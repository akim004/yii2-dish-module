<?php

namespace akim04\dish\models\backend;

use Yii;
use akim04\dish\models\backend\Ingredient;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * dishSearch represents the model behind the search form about `akim04\dish\models\dish`.
 */
class IngredientSearch extends \akim04\dish\models\common\Ingredient
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'status'], 'integer'],
			[['name'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		return Model::scenarios();
	}

	public function search($params){

		$query = Ingredient::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			$query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id'     => $this->id,
			'status' => $this->status,
		]);

		$query->andFilterWhere(['like', 'name', $this->name]);

		return $dataProvider;
	}
}
