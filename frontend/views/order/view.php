<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = 'Order #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'My Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="order-view">
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <h3>Order Details</h3>
    <table class="table table-bordered">
        <tr>
            <th>Order ID</th>
            <td><?= $model->id ?></td>
        </tr>
        <tr>
            <th>User ID</th>
            <td><?= $model->user? Html::encode($model->user->username):unknown ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $model->user? Html::encode($model->user->email):u ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= Html::encode($model->status) ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?= Html::encode($model->shipping_address)?></td>
        </tr>

        <tr>
            <th>Total Price</th>
            <td><?= number_format($model->total_price, 2) ?></td>
        </tr>
        <tr>
            <th>Created At</th>
            <td><?= $model->created_at ?></td>
        </tr>
    </table>

    <h3>Items in this Order</h3>
    <?php if (!empty($model->orderItems)): ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price (Each)</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->orderItems as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= Html::encode($item->product->name ?? 'Unknown') ?></td>
                        <td><?= $item->quantity ?></td>
                        <td>$<?= number_format($item->price, 2) ?></td>
                        <td>$<?= number_format($item->price * $item->quantity, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No items found in this order.</p>
    <?php endif; ?>
</div>
