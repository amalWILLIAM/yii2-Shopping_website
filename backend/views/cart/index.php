<?php

use backend\models\Cart;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\data\dataProvider;
/** @var yii\web\View $this */
/** @var backend\models\CartSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Carts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cart', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    // 'filterModel' => $searchModel, // remove or comment this line
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ],
]) ?>



</div>
