<?php
use yii\helpers\Html;

$this->title = 'Dashboard';
?>
<div class="container-fluid">
    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

    <p class="lead">Welcome, <?= Yii::$app->user->identity->username ?>!</p>

    <div class="row">
        <!-- Categories Card -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Categories</h5>
                    <p class="card-text">Manage your product categories.</p>
                    <?= Html::a('Go to Categories', ['/category/index'], ['class'=>'btn btn-light mt-auto']) ?>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text">View, add, or edit products.</p>
                    <?= Html::a('Go to Products', ['/product/index'], ['class'=>'btn btn-light mt-auto']) ?>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Orders</h5>
                    <p class="card-text">Manage customer orders.</p>
                    <?= Html::a('Go to Orders', ['/order/index'], ['class'=>'btn btn-light mt-auto']) ?>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-danger h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">Manage registered users.</p>
                    <?= Html::a('Go to Users', ['/user/index'], ['class'=>'btn btn-light mt-auto']) ?>
                </div>
            </div>
        </div>

        <!-- Cart Card -->
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">Cart</h5>
                    <p class="card-text">Manage cart items.</p>
                    <?= Html::a('Go to Cart', ['/cart/index'], ['class'=>'btn btn-light mt-auto']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
