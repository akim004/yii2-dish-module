<?php

use akim04\dish\Module;
use akim04\dish\models\backend\Dish;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = Module::t('module', 'Dishs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a(Module::t('module', 'Create dish'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			[
				'format' => 'raw',
				'header' => 'Ингредиенты',
				'value' => function($item){
					return implode(', ', ArrayHelper::map($item->ingredients, 'id', 'name'));
				}
			],
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}{delete}',
			],

		],
	]); ?>

</div>
