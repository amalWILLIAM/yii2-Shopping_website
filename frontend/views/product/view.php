<?php

use yii\helpers\Html;
/*@var $this yii\web\view */
/*@var $model fronend\models\Product*/

$this->title = Html::encode($model->name);
?>

<div class="product-detail container mt-5">

    <div class="row mt-4">
        <div class="col-md-6">
        <img src="<?= Yii::getAlias('@web/uploads/products/' . $model->image) ?>"
     alt="<?= Html::encode($model->name) ?>"
     class="img-fluid rounded shadow-sm w-100"
     style="object-fit: contain; ">

        </div> 
        
        <div class="col-md-6">

            <h2 class="mt-5"><?= Html::encode($model->name) ?>      
            <h4 class="mt-5">₹ <?= Html::encode($model->price) ?></h4>
            <p><?= Html::encode($model->description) ?>
            <br>
            <?= Html::a('Add to Cart', ['cart/add', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>    

