<?php

use akim04\dish\Module;
use akim04\dish\models\backend\Dish;
use akim04\dish\models\backend\Ingredient;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="dish-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'status')->dropDownList(Dish::getStatusesArray()) ?>


	<?php echo $form->field($model, 'ingredientIds')->widget(Select2::classname(), [
	    'data' => ArrayHelper::map(Ingredient::find()->all(), 'id', 'name'),
	    'language' => 'ru',
	    'options' => [
            'multiple' => true,
        ],
	    'pluginOptions' => [
	        'allowClear' => true
	    ],
	]);?>

	<hr>
	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? Module::t('module', 'Create') : Module::t('module', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
