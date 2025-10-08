<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $cartItems backend\models\CartItem[] */
?>

<body class="d-flex flex-column min-vh-100">
    <!-- Main content -->
    <main class="flex-fill container mt-4">
        <h2 class="mb-4 text-center">My Cart</h2>

        <?php if (empty($cartItems)): ?>
            <h3 class="text-center mt-5">Your cart is empty.</h3>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $grandTotal = 0;
                        foreach ($cartItems as $item): 
                            $total = $item->product->price * $item->quantity;
                            $grandTotal += $total;
                        ?>
                        <tr>
                            <td><?= Html::encode($item->product->name) ?></td>
                            <td>₹ <?= number_format($item->product->price, 2) ?></td>
                            <td><?= $item->quantity ?></td>
                            <td>₹ <?= number_format($total, 2) ?></td>
                            <td>
                                <?= Html::a('+', ['cart/increase', 'id' => $item->id], ['class' => 'btn btn-success btn-sm me-1']) ?>
                                <?= Html::a('-', ['cart/decrease', 'id' => $item->id], ['class' => 'btn btn-warning btn-sm me-1']) ?>
                               
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <!-- Grand Total Row -->
                        <tr class="table-secondary">
                            <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                            <td colspan="2"><strong>₹ <?= number_format($grandTotal, 2) ?></strong></td>
                        </tr>

                        <tr>
                            <td colspan="5" class="text-end">
                                <?= Html::a('Continue Shopping', ['category/index'], ['class' => 'btn btn-primary btn-lg']) ?>
                        
                                <?= Html::a('Proceed to Checkout', ['cart/checkout'], ['class' => 'btn btn-primary btn-lg']) ?>
                     </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 pt-4 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>About Us</h5>
                    <p>My Shop is your one-stop destination for all your favorite products. Quality guaranteed, delivered fast.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= Url::to(['site/index']) ?>" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="<?= Url::to(['product/index']) ?>" class="text-white text-decoration-none">Products</a></li>
                        <li><a href="<?= Url::to(['site/contact']) ?>" class="text-white text-decoration-none">Contact</a></li>
                        <li><a href="<?= Url::to(['site/about']) ?>" class="text-white text-decoration-none">About</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Contact Us</h5>
                    <p>Email: support@myshop.com</p>
                    <p>Phone: +91 123 456 7890</p>
                    <p>Address: 123 Market Street, City, Country</p>
                </div>
            </div>
            <div class="text-center mt-3 border-top border-secondary pt-2">
                &copy; <?= date('Y') ?> My Shop. All rights reserved.
            </div>
        </div>
    </footer>
</body>
