<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'About Us';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container my-5">
    <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

    <div class="row align-items-center">
        <div class="col-md-6 mb-4">
            <img src="<?= Url::to('@web/images/banner.png') ?>" class="img-fluid rounded shadow" alt="About Us">
        </div>
        <div class="col-md-6">
            <h3>Our Story</h3>
            <p>My Shop was founded with a mission to bring quality products directly to your doorstep. 
            We believe in providing excellent customer service, fast delivery, and a wide variety of products 
            to meet your needs.</p>

            <h3>Our Vision</h3>
            <p>We aim to become the most trusted online store, where customers can shop confidently, 
            knowing they are getting the best products at the best prices.</p>

            <h3>Our Values</h3>
            <ul>
                <li>Customer Satisfaction First</li>
                <li>Quality Products</li>
                <li>Fast and Reliable Delivery</li>
                <li>Integrity and Transparency</li>
            </ul>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col text-center">
            <?= Html::a('Back to Home', ['site/index'], ['class' => 'btn btn-primary btn-lg']) ?>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white mt-5 pt-4 pb-2">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <h5>About Us</h5>
                <p>My Shop is your one-stop destination for all your favorite products. Quality guaranteed, delivered fast.</p>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="<?= Url::to(['site/index']) ?>" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="<?= Url::to(['product/index']) ?>" class="text-white text-decoration-none">Products</a></li>
                    <li><a href="<?= Url::to(['site/contact']) ?>" class="text-white text-decoration-none">Contact</a></li>
                    <li><a href="<?= Url::to(['site/about']) ?>" class="text-white text-decoration-none">About</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-3">
                <h5>Contact Us</h5>
                <p>Email: support@myshop.com</p>
                <p>Phone: +91 123 456 7890</p>
                <p>Address: 123 Market Street, City, Country</p>
            </div>
        </div>
        <div class="text-center mt-3 border-top border-secondary pt-2">
            &copy; <?= date('Y') ?> My Shop. All rights reserved.
        </div>
    </div>
</footer>
