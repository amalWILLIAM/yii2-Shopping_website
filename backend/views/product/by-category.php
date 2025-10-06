<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $category backend\models\Category */
/* @var $products backend\models\Product[] */

$this->title = Html::encode($category->name);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-4">
    <h1 class="mb-4 text-center"><?= Html::encode($category->name) ?></h1>

    <?php if (!empty($products)): ?>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if ($product->image): ?>
                            <img src="<?= Yii::getAlias('@web/uploads/product/' . $product->image) ?>" 
                                 class="card-img-top img-fluid" 
                                 alt="<?= Html::encode($product->name) ?>" 
                                 style="max-height: 250px; object-fit: cover;">
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= Html::encode($product->name) ?></h5>
                            <p class="card-text"><?= Html::encode($product->description) ?></p>
                            <p class="card-text fw-bold mt-auto">Price: ₹<?= Html::encode($product->price) ?></p>
                        </div>

                        <div class="card-footer text-center">
                            <?= Html::a('View Product', ['product/view', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">No products found in this category.</p>
    <?php endif; ?>
</div>
