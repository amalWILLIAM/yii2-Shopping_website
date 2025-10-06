<?php
namespace frontend\controllers;

use yii\web\Controller;
use backend\models\Category; // use backend models

class CategoryController extends Controller
{
    public function actionIndex()
    {
        // Get all categories from backend
        $categories = Category::find()->all();

        return $this->render('index', [
            'categories' => $categories,
        ]);
    }
}
