<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body { padding-top: 60px; }
        .sidebar { height: 100vh; position: fixed; top: 60px; left: 0; padding: 1rem; overflow-y: auto; background-color: #f8f9fa; }
        .nav-link.active { font-weight: 600; color: #0d6efd !important; }
        .nav-link:hover { background-color: #e9ecef; border-radius: 0.25rem; }
        .content-wrapper { margin-left: 18rem; padding: 2rem; }
        footer { background-color: #f8f9fa; }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<!-- Top Navbar -->
<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);

    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);

    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',
            Html::a('Login', ['/site/login'], ['class' => 'btn btn-outline-light']),
            ['class' => 'd-flex']
        );
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-outline-light']
            )
            . Html::endForm();
    }

    NavBar::end();
    ?>
</header>

<!-- Sidebar -->
<nav class="sidebar col-md-3 col-lg-2 d-md-block bg-light collapse">
    <ul class="nav flex-column">
        <li class="nav-item"><?= Html::a('Dashboard', ['/site/index'], ['class'=>'nav-link']) ?></li>
        <li class="nav-item"><?= Html::a('Categories', ['/category/index'], ['class'=>'nav-link']) ?></li>
        <li class="nav-item"><?= Html::a('Products', ['/product/index'], ['class'=>'nav-link']) ?></li>
        <li class="nav-item"><?= Html::a('Orders', ['/order/index'], ['class'=>'nav-link']) ?></li>
        <li class="nav-item"><?= Html::a('Users', ['/user/index'], ['class'=>'nav-link']) ?></li>
        <li class="nav-item"><?= Html::a('Cart', ['/cart/index'], ['class'=>'nav-link']) ?></li>
    </ul>
</nav>

<!-- Page Content -->
<div class="content-wrapper">
    <?= Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'] ?? [],
        'options' => ['class' => 'breadcrumb mb-3'],
    ]) ?>
    <?= Alert::widget() ?>

    <div class="container-fluid">
        <?= $content ?>
    </div>
</div>

<!-- Footer -->
<!-- <footer class="footer mt-auto py-3 text-muted">
    <div class="container d-flex justify-content-between">
        <span>&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></span>
        <span><?= Yii::powered() ?></span>
    </div>
</footer> -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
