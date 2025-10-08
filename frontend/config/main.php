<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);


return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    
    'controllerNamespace' => 'frontend\controllers',
    'aliases' => [
        '@frontendUrl' => 'http://localhost/amal/shopping_web/frontend/web', // adjust to your local URL
    ],
    


    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'on afterLogin' => function($event) {
                $sessionCart = Yii::$app->session->get('cart', []);
                if (!empty($sessionCart)) {
                    $userId = Yii::$app->user->id;
                    
                    // Find or create database cart
                    $cart = \backend\models\Cart::findOne(['user_id' => $userId]);
                    if (!$cart) {
                        $cart = new \backend\models\Cart();
                        $cart->user_id = $userId;
                        $cart->save();
                    }
    
                    // Merge session cart into database
                    foreach ($sessionCart as $productId => $item) {
                        $cartItem = \frontend\models\CartItem::findOne([
                            'cart_id' => $cart->id,
                            'product_id' => $productId
                        ]);
                        if ($cartItem) {
                            $cartItem->quantity += $item['quantity'];
                            $cartItem->save();
                        } else {
                            $cartItem = new \frontend\models\CartItem();
                            $cartItem->cart_id = $cart->id;
                            $cartItem->product_id = $productId;
                            $cartItem->quantity = $item['quantity'];
                            $cartItem->save();
                        }
                    }
    
                    // Clear session cart
                    Yii::$app->session->remove('cart');
                }
            },
        ],
    ],
    
    
    
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],

      
        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
