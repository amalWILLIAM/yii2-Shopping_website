<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Category $model */

$this->title = 'Update Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>

<div class="category-update container-fluid">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4"><?= Html::encode($this->title) ?></h2>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
