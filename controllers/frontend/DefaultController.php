<?php

namespace akim04\dish\controllers\frontend;

use Yii;
use akim04\dish\models\frontend\DishSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

class DefaultController extends Controller
{
	public function actionIndex(){

		$searchModel = new DishSearch();
		$dishes = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dishes,
		]);
	}
}
