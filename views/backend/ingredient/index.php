<?php

use akim04\dish\Module;
use akim04\dish\models\backend\Ingredient;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Module::t('module', 'Ingredients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a(Module::t('module', 'Create ingredient'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'name',
			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}{delete}',
			],

		],
	]); ?>

</div>
