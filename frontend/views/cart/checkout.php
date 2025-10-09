<?php

/** @var yii\web\View $this */
/** @var frontend\models\CheckoutForm $model */
/** @var yii\bootstrap5\ActiveForm $form */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Checkout';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-checkout">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please provide your shipping details to complete the order:</p>

    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin([
                'id' => 'checkout-form',
                'options' => ['class' => 'p-4 border rounded shadow-sm bg-light']
            ]); ?>

                <?= $form->field($model, 'shipping_address')->textarea(['rows' => 3, 'placeholder' => 'Enter your full shipping address']) ?>

                <?= $form->field($model, 'phone')->textInput(['placeholder' => 'Enter your phone number']) ?>

                <?= $form->field($model, 'payment')->hiddenInput(['value' => 'Cash on Delivery'])->label(false) ?>
                <div class="mb-3">
                    <label class="form-label">Payment Method:</label>
                    <p><strong>Cash on Delivery</strong></p>
                </div>

                <div class="form-group mt-3">
                    <?= Html::submitButton('Place Order', ['class' => 'btn btn-success btn-lg']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
