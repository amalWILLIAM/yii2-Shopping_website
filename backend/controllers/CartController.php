<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\Cart;
use frontend\models\CartItem;
use frontend\models\Product;
use yii\data\dataProvider;
use yii\data\ArrayDataProvider;

class CartController extends Controller
{
    /**
     * Add product to cart
     */
    public function actionAdd($id)
    {
        if (Yii::$app->user->isGuest) {
            throw new NotFoundHttpException('You must be logged in to add products to the cart.');
        }

        $product = Product::findOne($id);
        if (!$product) {
            throw new NotFoundHttpException('Product not found');
        }

        $userId = Yii::$app->user->id;
        $cart = Cart::findOne(['user_id' => $userId]);

        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->created_at = time();
            $cart->updated_at = time();
            $cart->save();
        }

        $cartItem = CartItem::findOne(['cart_id' => $cart->id, 'product_id' => $id]);
        if ($cartItem) {
            $cartItem->quantity += 1;
        } else {
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;
            $cartItem->product_id = $id;
            $cartItem->quantity = 1;
        }

        $cartItem->save();
        Yii::$app->session->setFlash('success', 'Product added to cart!');
        return $this->redirect(['index']);
    }

    /**
     * Show cart items
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            throw new NotFoundHttpException('You must be logged in to view the cart.');
        }



$cart = Cart::findOne(['user_id' => Yii::$app->user->id]);
$cartItems = $cart ? $cart->cartItems : [];

$dataProvider = new ArrayDataProvider([
    'allModels' => $cartItems,
    'pagination' => [
        'pageSize' => 10,
    ],
]);

return $this->render('index', [
    'dataProvider' => $dataProvider,
]);

    }

    /**
     * Increase product quantity
     */
    public function actionIncrease($id)
    {
        $this->updateQuantity($id, 1);
        return $this->redirect(['index']);
    }

    /**
     * Decrease product quantity
     */
    public function actionDecrease($id)
    {
        $this->updateQuantity($id, -1);
        return $this->redirect(['index']);
    }

    /**
     * Remove product from cart
     */
    public function actionRemove($id)
    {
        $userId = Yii::$app->user->id;
        $cart = Cart::findOne(['user_id' => $userId]);
        if ($cart) {
            $cartItem = CartItem::findOne(['cart_id' => $cart->id, 'product_id' => $id]);
            if ($cartItem) {
                $cartItem->delete();
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Helper method to increase or decrease quantity
     */
    private function updateQuantity($productId, $delta)
    {
        $userId = Yii::$app->user->id;
        $cart = Cart::findOne(['user_id' => $userId]);
        if ($cart) {
            $cartItem = CartItem::findOne(['cart_id' => $cart->id, 'product_id' => $productId]);
            if ($cartItem) {
                $cartItem->quantity += $delta;
                if ($cartItem->quantity <= 0) {
                    $cartItem->delete();
                } else {
                    $cartItem->save();
                }
            }
        }
    }
}
