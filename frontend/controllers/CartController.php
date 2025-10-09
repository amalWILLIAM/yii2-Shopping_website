<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\models\Cart;
use common\models\CartItem;
use common\models\Product;
use common\models\Order;
use common\models\OrderItem;

class CartController extends Controller
{
    /**
     * Add product to cart
     */
    public function actionAdd($id)
    {
        // Find the product
        $product = Product::findOne($id);
        if (!$product) {
            throw new NotFoundHttpException('Product not found');
        }

        // Only for logged-in users
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Please login to add products to cart.');
        }

        $userId = Yii::$app->user->id;

        // Find or create user's cart
        $cart = Cart::findOne(['user_id' => $userId]);
        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $userId;
            $cart->created_at = time();
            $cart->updated_at = time();
            $cart->save();
        }

        // Find or create cart item
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
        return $this->redirect(['cart/index']);
    }

    /**
     * Show cart items
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Please login to view your cart.');
        }

        $userId = Yii::$app->user->id;
        $cart = Cart::findOne(['user_id' => $userId]);
        $cartItems = $cart ? $cart->cartItems : [];

        return $this->render('index', [
            'cartItems' => $cartItems,
        ]);
    }

    /**
     * Increase quantity
     */
    public function actionIncrease($id)
    {
        $cartItem = CartItem::findOne($id);
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save(false);
        }
        return $this->redirect(['index']);
    }

    /**
     * Decrease quantity
     */
    public function actionDecrease($id)
    {
        $cartItem = CartItem::findOne($id);
        if ($cartItem) {
            $cartItem->quantity -= 1;
            if ($cartItem->quantity < 1) {
                $cartItem->delete();
            } else {
                $cartItem->save(false);
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Remove item from cart
     */
    public function actionRemove($id)
    {
        $cartItem = CartItem::findOne($id);
        if ($cartItem) {
            $cartItem->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Checkout process
     */
    // public function actionCheckout()
    // {
    //     $userId = Yii::$app->user->id;
    //     $cart = Cart::findOne(['user_id' => $userId]);

    //     if (!$cart || empty($cart->cartItems)) {
    //         Yii::$app->session->setFlash('error', 'Your cart is empty.');
    //         return $this->redirect(['cart/index']);
    //     }

    //     $transaction = Yii::$app->db->beginTransaction();

    //     try {
    //         // Create order
    //         $order = new Order();
    //         $order->user_id = $userId;
    //         $order->total_price = $cart->getTotal();
    //         $order->status = 'placed';
    //         $order->created_at = time();   // integer timestamp
    //         $order->updated_at = time(); 

    //         if (!$order->save()) {
    //             throw new \Exception('Order not saved: ' . json_encode($order->errors));
                
    //         }

    //         // Create order items
    //         foreach ($cart->cartItems as $cartItem) {
    //             $orderItem = new OrderItem();
    //             $orderItem->order_id = $order->id;
    //             $orderItem->product_id = $cartItem->product_id;
    //             $orderItem->quantity = $cartItem->quantity;
    //             $orderItem->price = $cartItem->product->price;

    //             if (!$orderItem->save()) {
    //                 throw new \Exception('OrderItem not saved: ' . json_encode($orderItem->errors));
    //                 echo '<pre>';
    //             print_r($orderItem->errors);
    //             exit();
    //             }
    //         }

    //         // Clear cart
    //         foreach ($cart->cartItems as $cartItem) {
    //             $cartItem->delete();
    //         }

    //         $transaction->commit();

    //         Yii::$app->session->setFlash('success', 'Order placed successfully!');
    //         return $this->redirect(['order/view', 'id' => $order->id]);

    //     } catch (\Exception $e) {
    //         $transaction->rollBack();
    //         Yii::$app->session->setFlash('error', 'Checkout failed: ' . $e->getMessage());
    //         return $this->redirect(['category/index']);
    //         // echo '<pre>';
    //         // print_r($e->getMessage());
    //         // exit();
    //     }
    // }

    public function actionCheckout()
    {
        $user_id = Yii::$app->user->id;
    
        $cart = \common\models\Cart::findOne(['user_id' => $user_id]);
        if (!$cart || empty($cart->cartItems)) {
            Yii::$app->session->setFlash('error', 'Cart is empty');
            return $this->redirect(['cart/index']);
        }
    
        $model = new \frontend\models\CheckoutForm();
    
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $order = new \common\models\Order();
                $order->user_id = $user_id;
                $order->total_price = $cart->getTotal();
                $order->status = 'Confirmed';
                $order->shipping_address =$model->shipping_address;
                $order->phone = $model->phone;
                $order->payment = 'cash on delivery';
                $order->created_at = time();
                $order->updated_at = time();
    
                if (!$order->save()) {
                    throw new \Exception('Order not saved: ' . json_encode($order->errors));
                }
    
                foreach ($cart->cartItems as $cartItem) {
                    $orderItem = new \common\models\OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $cartItem->product_id;
                    $orderItem->quantity = $cartItem->quantity;
                    $orderItem->price = $cartItem->product->price;

                    if (!$orderItem->save()) {
                        throw new \Exception('OrderItem not saved: ' . json_encode($orderItem->errors));
                    }
                }
    
                // Clear cart
                foreach ($cart->cartItems as $cartItem) {
                    $cartItem->delete();
                }
    
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Order placed successfully!');
                return $this->redirect(['order/view', 'id' => $order->id]);
    
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Checkout failed: ' . $e->getMessage());
                return $this->redirect(['cart/index']);
            }
        }
    
        return $this->render('checkout', ['model' => $model]);
    }
    
}
