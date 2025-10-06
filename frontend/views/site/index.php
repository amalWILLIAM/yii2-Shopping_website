<?php
/* @var $this yii\web\View */
/* @var $categories frontend\models\Category[] */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<!-- Banner -->
<div class="jumbotron jumbotron-fluid text-white" style="
    background-image: url('<?= Yii::getAlias('@web/images/banner.jpg') ?>');
    background-size: cover;
    background-position: center;
    height: 800px;
    display: flex;
    align-items: center;
    justify-content: center;
">
</div>

<!-- Categories Grid -->
<div class="container mt-5">
    <h2 class="mb-4 text-center">Shop by Category</h2>

    <?php if (!empty($categories)): ?>
        <div class="row row-cols-1 row-cols-md-3 g-4"> <!-- now 3 per row -->
            <?php foreach ($categories as $category): ?>
                <div class="col">
                    <a href="<?= Url::to(['product/by-category', 'id' => $category->id]) ?>" style="text-decoration: none; color: inherit;">
                        <div class="card h-100 shadow-sm" style="min-width: 250px;"> <!-- custom min width -->
                            <img src="<?= Yii::getAlias('@web') . '/uploads/categories/' . $category->image ?>" 
                                 class="card-img-top img-fluid" 
                                 alt="<?= Html::encode($category->name) ?>" 
                                 style="object-fit: cover; height: 400px;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= Html::encode($category->name) ?></h5>
                                <p class="card-text flex-grow-1"><?= Html::encode($category->description) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">No categories found.</p>
    <?php endif; ?>
</div>

</div>
