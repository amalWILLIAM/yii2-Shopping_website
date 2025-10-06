<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\data\Pagination;
use backend\models\Category;



/** @var yii\web\View $this */
/** @var backend\models\Category $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-form card shadow-sm p-4">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Enter category name']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4, 'placeholder' => 'Optional description']) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>





    <div class="form-group mt-3">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['index'], ['class'=>'btn btn-secondary ms-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
