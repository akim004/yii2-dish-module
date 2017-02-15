<?php

use akim04\dish\Module;
use akim04\dish\models\backend\Ingredient;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="dish-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'status')->dropDownList(Ingredient::getStatusesArray()) ?>

	<?/*php echo $form->field($model, 'ingredient')->widget(Select2::classname(), [
	    'data' => $data,
	    'language' => 'de',
	    'options' => ['placeholder' => 'Select a state ...'],
	    'pluginOptions' => [
	        'allowClear' => true
	    ],
	]);*/?>

	<hr>
	<div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? Module::t('module', 'Create') : Module::t('module', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
