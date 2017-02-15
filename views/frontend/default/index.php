<?php

use akim04\dish\Module;
use akim04\dish\models\common\Ingredient;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Module::t('module', 'Dishs');
?>

<div class="dish-form">

	<?php $form = ActiveForm::begin([
		'method' => 'GET',
	]); ?>

	<?php echo $form->field($searchModel, 'ingredientIds')->widget(Select2::classname(), [
		'data' => ArrayHelper::map(Ingredient::find()->active()->all(), 'id', 'name'),
		'language' => 'ru',
		'options' => [
			'multiple' => true,
		],
		'pluginOptions' => [
			'allowClear' => true
		],
	]);?>

	<div class="form-group">
		<?= Html::submitButton('Найти', ['class' => 'btn btn-success']) ?>
	</div>

	<hr>
	<?php ActiveForm::end(); ?>

</div>

<div class="dish-index">
	<h3>Найденные блюда</h3>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			[
				'attribute' => 'ingredient_count',
				'filter' => false,
			],
		],
	]); ?>

</div>
