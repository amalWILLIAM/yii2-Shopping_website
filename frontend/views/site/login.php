<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login d-flex justify-content-center align-items-center" style="min-height: 80vh; background: #f8f9fa;">
    <div class="card shadow-sm p-4" style="width: 400px; border-radius: 15px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold"><?= Html::encode($this->title) ?></h2>
            <p class="text-muted">Please fill out the following fields to login</p>
        </div>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'needs-validation'],
        ]); ?>

            <?= $form->field($model, 'username')->textInput([
                'autofocus' => true,
                'class' => 'form-control form-control-lg',
                'placeholder' => 'Enter your username'
            ]) ?>

            <?= $form->field($model, 'password')->passwordInput([
                'class' => 'form-control form-control-lg',
                'placeholder' => 'Enter your password'
            ]) ?>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'form-check-input me-2']) ?>
                <div class="small text-muted text-end">
                    <?= Html::a('Forgot password?', ['site/request-password-reset']) ?>
                </div>
            </div>

            <div class="d-grid mb-3">
                <?= Html::submitButton('Login', [
                    'class' => 'btn btn-primary btn-lg fw-bold',
                    'name' => 'login-button'
                ]) ?>
            </div>

           

        <?php ActiveForm::end(); ?>
    </div>
</div>
