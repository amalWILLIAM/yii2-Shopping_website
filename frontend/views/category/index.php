<?php
/* @var $this yii\web\View */
/* @var $categories frontend\models\Category[] */
use yii\helpers\Html;
use yii\helpers\Url;
?>


<!-- Categories Grid -->
<div class="container mt-5" style="margin-bottom: 47px;">
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

<!-- Footer -->
<footer class="bg-dark text-white mt-5">
    <div class="container py-4">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4 mb-3">
                <h5>About Us</h5>
                <p>My Shop is your one-stop destination for all your favorite products. Quality guaranteed, delivered fast.</p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="<?= Url::to(['site/index']) ?>" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="<?= Url::to(['product/index']) ?>" class="text-white text-decoration-none">Products</a></li>
                    <li><a href="<?= Url::to(['site/contact']) ?>" class="text-white text-decoration-none">Contact</a></li>
                    <li><a href="<?= Url::to(['site/about']) ?>" class="text-white text-decoration-none">About</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 mb-3">
                <h5>Contact Us</h5>
                <p>Email: support@myshop.com</p>
                <p>Phone: +91 123 456 7890</p>
                <p>Address: 123 Market Street, City, Country</p>
            </div>
        </div>

        <div class="text-center mt-3">
            &copy; <?= date('Y') ?> My Shop. All rights reserved.
        </div>
    </div>
</footer>


</div>
