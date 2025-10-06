<?php

use backend\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><?= Html::encode($this->title) ?></h2>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-striped table-bordered'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',
                    'description:ntext',
                    [
                        'attribute' => 'created_at',
                        'format' => ['datetime', 'php:d M Y H:i']
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => ['datetime', 'php:d M Y H:i']
                    ],
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Category $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'contentOptions' => ['class' => 'text-center'],
                        'header' => 'Actions',
                    ],

                    
                ],
                
            ]); ?>
                <!-- <?php echo LinkPager::widget(['pagination' => $dataProvider->pagination,]); ?> -->

        </div>
    </div>
</div>
