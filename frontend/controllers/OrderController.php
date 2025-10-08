<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\models\Order;
use yii\data\ActiveDataProvider;

class OrderController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Please login to view orders.');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->where(['user_id' => Yii::$app->user->id])->orderBy(['created_at' => SORT_DESC]),
            'pagination' => ['pageSize' => 10],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException('You are not allowed to view this order.');
        }

        return $this->render('view', ['model' => $model]);
    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
