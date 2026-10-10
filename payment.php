<?php
session_start();
require_once __DIR__ . '/config/database.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_error'] = 'Silakan login terlebih dahulu.';
    header('Location: login.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    $_SESSION['flash_error'] = 'Keranjang Anda kosong.';
    header('Location: cart.php');
    exit;
}

$courierPrices = [
    'jne' => 15000,
    'jnt' => 17000,
    'sicepat' => 14000,
];

$products = [];
$subtotal = 0;

$ids = array_keys($cart);
if (!empty($ids)) {
    $in = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $in . ')');
    $stmt->execute($ids);
    $products = $stmt->fetchAll();
}

foreach ($products as $product) {
    $qty = $cart[$product['id']];
    $subtotal += $product['price'] * $qty;
}

$selectedCourier = 'jne';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedCourier = $_POST['courier'] ?? 'jne';
    $paymentMethod = $_POST['payment_method'] ?? 'bank_transfer';
    $address = trim($_POST['address'] ?? '');

    if ($address === '') {
        $address = $_SESSION['user_address'] ?? 'Alamat pengiriman belum diisi';
    }

    $shippingFee = $courierPrices[$selectedCourier] ?? 0;
    $total = $subtotal + $shippingFee;

    $pdo->beginTransaction();

    $orderStmt = $pdo->prepare('INSERT INTO orders (user_id, total, shipping_fee, payment_method, courier, address, status, created_at) VALUES (:user_id, :total, :shipping_fee, :payment_method, :courier, :address, :status, NOW())');
    $orderStmt->execute([
        'user_id' => $_SESSION['user_id'],
        'total' => $total,
        'shipping_fee' => $shippingFee,
        'payment_method' => $paymentMethod,
        'courier' => $selectedCourier,
        'address' => $address,
        'status' => 'pending',
    ]);
    $orderId = $pdo->lastInsertId();

    foreach ($products as $product) {
        $qty = $cart[$product['id']];
        $itemStmt = $pdo->prepare('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)');
        $itemStmt->execute([
            'order_id' => $orderId,
            'product_id' => $product['id'],
            'quantity' => $qty,
            'price' => $product['price'],
        ]);
    }

    $paymentStmt = $pdo->prepare('INSERT INTO payments (order_id, amount, method, status, created_at) VALUES (:order_id, :amount, :method, :status, NOW())');
    $paymentStmt->execute([
        'order_id' => $orderId,
        'amount' => $total,
        'method' => $paymentMethod,
        'status' => 'pending',
    ]);

    $pdo->commit();

    $_SESSION['cart'] = [];
    header('Location: payment.php?order_id=' . (int)$orderId);
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Shopee Clone</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <div class="page-container checkout-page">
        <div class="section-header">
            <h2>Checkout</h2>
        </div>

        <form method="POST" class="checkout-form">
            <div class="checkout-grid">
                <div class="checkout-card">
                    <h3>Alamat Pengiriman</h3>
                    <div class="field-group">
                        <label for="address">Alamat</label>
                        <textarea id="address" name="address" rows="4" placeholder="Masukkan alamat lengkap"><?= htmlspecialchars($_SESSION['user_address'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="checkout-card">
                    <h3>Pilih Kurir</h3>
                    <div class="courier-options">
                        <label class="courier-item">
                            <input type="radio" name="courier" value="jne" <?= $selectedCourier === 'jne' ? 'checked' : '' ?>>
                            <span>JNE</span>
                            <strong>Rp 15.000</strong>
                        </label>
                        <label class="courier-item">
                            <input type="radio" name="courier" value="jnt" <?= $selectedCourier === 'jnt' ? 'checked' : '' ?>>
                            <span>J&T</span>
                            <strong>Rp 17.000</strong>
                        </label>
                        <label class="courier-item">
                            <input type="radio" name="courier" value="sicepat" <?= $selectedCourier === 'sicepat' ? 'checked' : '' ?>>
                            <span>SiCepat</span>
                            <strong>Rp 14.000</strong>
                        </label>
                    </div>
                </div>
            </div>

            <div class="checkout-card payment-card">
                <h3>Metode Pembayaran</h3>
                <div class="payment-methods">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="bank_transfer" checked>
                        <span>Bank Transfer</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="ewallet">
                        <span>E-Wallet</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="cod">
                        <span>Cash on Delivery</span>
                    </label>
                </div>
            </div>

            <div class="checkout-summary-box">
                <h3>Ringkasan Pesanan</h3>
                <?php foreach ($products as $product): ?>
                    <?php $qty = $cart[$product['id']]; ?>
                    <div class="summary-item">
                        <span><?= htmlspecialchars($product['name']) ?> x <?= $qty ?></span>
                        <strong>Rp <?= number_format($product['price'] * $qty, 0, ',', '.') ?></strong>
                    </div>
                <?php endforeach; ?>
                <div class="summary-item">
                    <span>Subtotal</span>
                    <strong>Rp <?= number_format($subtotal, 0, ',', '.') ?></strong>
                </div>
                <div class="summary-item">
                    <span>Ongkir</span>
                    <strong>Rp <?= number_format($courierPrices[$selectedCourier] ?? 0, 0, ',', '.') ?></strong>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <strong>Rp <?= number_format($subtotal + ($courierPrices[$selectedCourier] ?? 0), 0, ',', '.') ?></strong>
                </div>
                <button type="submit" class="primary-btn full-width">Bayar Sekarang</button>
            </div>
        </form>
    </div>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>
