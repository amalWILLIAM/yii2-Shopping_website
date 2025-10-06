<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\CategorySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-search card p-3 mb-3 shadow-sm">

    <h5 class="mb-3">Search Categories</h5>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'row g-3'], // Bootstrap spacing
    ]); ?>

    <div class="col-md-2">
        <?= $form->field($model, 'id')->textInput(['placeholder' => 'ID'])->label(false) ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Category name'])->label(false) ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'description')->textInput(['placeholder' => 'Description'])->label(false) ?>
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary me-2']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
