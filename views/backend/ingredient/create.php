<?php

use akim04\dish\Module;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model akim04\user\models\User */

$this->title = Module::t('module', 'Create ingredient');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Ingredients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
