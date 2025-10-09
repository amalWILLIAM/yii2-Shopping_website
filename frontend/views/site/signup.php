<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup d-flex justify-content-center align-items-center" style="min-height: 80vh; background: #f8f9fa;">
    <div class="card shadow-sm p-4" style="width: 400px; border-radius: 15px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold"><?= Html::encode($this->title) ?></h2>
            <p class="text-muted">Please fill out the following fields to signup</p>
        </div>

        <?php $form = ActiveForm::begin([
            'id' => 'form-signup',
            'options' => ['class' => 'needs-validation'],
        ]); ?>

            <?= $form->field($model, 'username')->textInput([
                'autofocus' => true,
                'class' => 'form-control form-control-lg',
                'placeholder' => 'Enter your username'
            ]) ?>

            <?= $form->field($model, 'email')->textInput([
                'class' => 'form-control form-control-lg',
                'placeholder' => 'Enter your email'
            ]) ?>

            <?= $form->field($model, 'password')->passwordInput([
                'class' => 'form-control form-control-lg',
                'placeholder' => 'Enter your password'
            ]) ?>

            <div class="d-grid mb-3">
                <?= Html::submitButton('Signup', [
                    'class' => 'btn btn-success btn-lg fw-bold',
                    'name' => 'signup-button'
                ]) ?>
            </div>

            <div class="text-center small text-muted">
                Already have an account? <?= Html::a('Login', ['site/login']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
