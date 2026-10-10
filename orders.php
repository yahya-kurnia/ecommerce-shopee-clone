<?php
session_start();
require_once __DIR__ . '/config/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$orderId = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
if ($orderId <= 0) {
    $_SESSION['flash_error'] = 'Order tidak valid.';
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT o.*, p.method AS payment_method, p.status AS payment_status, p.amount AS payment_amount FROM orders o LEFT JOIN payments p ON p.order_id = o.id WHERE o.id = :id AND o.user_id = :user_id LIMIT 1');
$stmt->execute(['id' => $orderId, 'user_id' => $_SESSION['user_id']]);
$order = $stmt->fetch();

if (!$order) {
    $_SESSION['flash_error'] = 'Order tidak ditemukan.';
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $method = $_POST['payment_method'] ?? $order['payment_method'];
    $pdo->prepare('UPDATE payments SET method = :method, status = :status WHERE order_id = :order_id')->execute([
        'method' => $method,
        'status' => 'paid',
        'order_id' => $orderId,
    ]);
    $pdo->prepare('UPDATE orders SET status = :status WHERE id = :id')->execute([
        'status' => 'paid',
        'id' => $orderId,
    ]);
    $_SESSION['flash_success'] = 'Pembayaran berhasil diproses.';
    header('Location: orders.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | Shopee Clone</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <div class="page-container">
        <div class="section-header">
            <h2>Pembayaran</h2>
        </div>

        <div class="checkout-card payment-card payment-page">
            <h3>Order #<?= (int)$order['id'] ?></h3>
            <p>Total Tagihan: <strong>Rp <?= number_format($order['total'], 0, ',', '.') ?></strong></p>
            <p>Metode Pengiriman: <strong><?= strtoupper(htmlspecialchars($order['courier'])) ?></strong></p>

            <form method="POST" class="payment-form">
                <div class="payment-methods">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="bank_transfer" <?= ($order['payment_method'] === 'bank_transfer' || empty($order['payment_method'])) ? 'checked' : '' ?>>
                        <span>Transfer Bank</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="ewallet" <?= $order['payment_method'] === 'ewallet' ? 'checked' : '' ?>>
                        <span>E-Wallet</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="cod" <?= $order['payment_method'] === 'cod' ? 'checked' : '' ?>>
                        <span>Cash on Delivery</span>
                    </label>
                </div>
                <button type="submit" class="primary-btn">Konfirmasi Pembayaran</button>
            </form>
        </div>
    </div>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>
