<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        'description:ntext',
        [
            'attribute' => 'image',
            'format' => 'html',
            'value' => function($model) {
                return $model->image
                    ? Html::img(Yii::getAlias('@web') . '/' . $model->image, ['width' => '150'])
                    : '(No Image)';
            },
        ],
        [
            'attribute' => 'created_at',
            'format' => ['datetime', 'php:d M Y H:i'],
        ],
        [
            'attribute' => 'updated_at',
            'format' => ['datetime', 'php:d M Y H:i'],
        ],
    ],
    ]) ?>



</div>
