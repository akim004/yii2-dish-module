<?php

namespace akim04\dish\controllers\backend;

use Yii;
use akim04\dish\Module;
use akim04\dish\models\backend\Ingredient;
use akim04\dish\models\backend\IngredientSearch;
use dosamigos\editable\EditableAction;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * dishsController implements the CRUD actions for dish model.
 */
class IngredientController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['admin'],
					],
				],
			],
		];
	}

	public function actions()
	{
		return [

		];
	}

	/**
	 * Lists all dish models.
	 * @return mixed
	 */
	public function actionIndex(){

		$searchModel = new IngredientSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionCreate(){

		$model = new Ingredient();
		$model->scenario = Ingredient::SCENARIO_ADMIN_CREATE;
		$model->status   = Ingredient::STATUS_ACTIVE;

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->getSession()->setFlash('success', Module::t('module', 'successfully added'));
			return $this->redirect(['index']);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing dish model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$model->scenario = Ingredient::SCENARIO_ADMIN_UPDATE;

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->getSession()->setFlash('success', Module::t('module', 'successfully changed'));
			return $this->redirect(['index']);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	public function actionDelete($id){

		$this->findModel($id)->delete();

		if (!Yii::$app->request->isAjax) {
			return $this->redirect(['index']);
		}
	}

	protected function findModel($id){

		if (($model = Ingredient::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
