<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Category $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="category-view container-fluid">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4"><?= Html::encode($this->title) ?></h2>

        <p class="mb-4">
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary me-2']) ?>
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
                    ? Html::img(Yii::getAlias('@web') . '/uploads/categories/' . $model->image, ['width' => '150']) 
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
    'options' => ['class' => 'table table-bordered'],
]) ?>



    </div>
</div>
