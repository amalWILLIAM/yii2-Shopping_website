<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Checkout Test';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="checkout-test">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Display flash messages -->
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div style="color:green;">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div style="color:red;">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <!-- Button to trigger checkout -->
    <p>
        <?= Html::a('Checkout Now', ['cart/checkout'], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
