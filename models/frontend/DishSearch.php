<?php

namespace akim04\dish\models\frontend;

use Yii;
use akim04\dish\models\common\Ingredient;
use akim04\dish\models\frontend\Dish;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;


class DishSearch extends \akim04\dish\models\frontend\Dish
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['status'], 'integer'],
			[['name', 'ingredientIds', 'ingredient_count', 'active'], 'safe'],
			[['ingredientIds'], 'required'],
			['ingredientIds', 'hasMoreElements']
		];
	}

	public function hasMoreElements($attribute, $params)
	{
	   	if (count($this->ingredientIds) <= 1) {
			$this->addError('ingredientIds', "Выберите больше ингредиентов");
		}

		if (count($this->ingredientIds) >= 5) {
			$this->addError('ingredientIds', "Можно выбрать только до 5 ингредиентов");
		}
	}

	public function attributeLabels()
	{
		return ArrayHelper::merge(parent::attributeLabels(), [
			'ingredientIds' => 'Выберите ингредиенты',
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		return Model::scenarios();
	}

	public function search($params){

		$query = Dish::find()->alias('d');

		$dataProvider = new ArrayDataProvider();

		$this->load($params);

		if (!$params || !$this->validate()) {
			// $query->where('0=1');
			return $dataProvider;
		}

		if($this->ingredientIds){
			$query
				->select(['d.*', 'COUNT(di.dish_id) ingredient_count'])
				->innerJoin('{{%dish_ingredient}} di', 'di.dish_id = d.id')
				->innerJoin('{{%ingredient}} i', 'di.ingredient_id = i.id')
				->where(['di.ingredient_id' => $this->ingredientIds])
				->groupBy('di.dish_id')
				->having('ingredient_count > 1')
				->orderBy('ingredient_count DESC')
				;
		}

		// Все нескрытые блюда
		$activeDishIds = (new \yii\db\Query())
			    ->select('di.dish_id')
			    ->from('{{%ingredient}} i')
			    ->innerJoin('{{%dish_ingredient}} di', 'di.ingredient_id = i.id')
			    ->groupBy('di.dish_id')
			    ->having(['SUM(i.status)' => Ingredient::STATUS_ACTIVE])
			    ;

		$query->andWhere(['d.id'=> $activeDishIds]);
		$query->andFilterWhere(['like', 'd.name', $this->name]);

		$all = $query->all();

		//Группируем по количеству совпавших ингредиентов
		if($all){
			foreach ($all as $item) {
				$result[$item->ingredient_count][] = $item;
			}
		}
		// Если есть полное совпадение, то выводим только их
		if(isset($result[count($this->ingredientIds)])){
			$all = $result[count($this->ingredientIds)];
		}


		$dataProvider->allModels = $all;

		return $dataProvider;
	}
}
