<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'] // important for file upload
]); ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'newPassword')->passwordInput() ?>
<?= $form->field($model, 'status')->dropDownList([
    10 => 'Active',
    9  => 'Inactive',
    0  => 'Deleted',
]) ?>

<!-- New file input for profile image -->
<?= $form->field($model, 'profileImageFile')->fileInput() ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', [
        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
    ]) ?>
</div>

<?php ActiveForm::end(); ?>

    <?php ActiveForm::end(); ?>

</div>
