<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Product;
use backend\models\Category;
use yii\web\NotFoundHttpException;

class ProductController extends Controller
{
    public function actionByCategory($id)
    {
        $category = Category::findOne($id);
        if (!$category) {
            throw new \yii\web\NotFoundHttpException('Category not found.');
        }

        $products = Product::find()->where(['category_id' => $id])->all();

        return $this->render('by-category', [
            'category' => $category,
            'products' => $products,
        ]);
    }


    public function actionView($id)
    {
        $model = Product::findOne($id);

        if($model == null)
        {
            throw new NotFoundhttpException('product not found');
        }

        return $this->render('view',['model' => $model]);
    }

}
