<?php

use akim04\dish\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model akim04\dish\models\Dish */
$this->title = Module::t('module', 'Update ingredient') . ': ' . $model->id;

$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Ingredients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Module::t('module', 'Update');
?>
<div class="ingredient-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
