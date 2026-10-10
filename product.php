<?php
session_start();
require_once __DIR__ . '/config/database.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_error'] = 'Silakan login terlebih dahulu.';
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC');
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan | Shopee Clone</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <div class="page-container">
        <div class="section-header">
            <h2>Riwayat Pesanan</h2>
        </div>

        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_SESSION['flash_success']) ?></div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <?php if (empty($orders)): ?>
            <div class="empty-box">
                <p>Belum ada pesanan.</p>
            </div>
        <?php else: ?>
            <div class="orders-list">
                <?php foreach ($orders as $order): ?>
                    <div class="order-card">
                        <div class="order-head">
                            <span>Order #<?= (int)$order['id'] ?></span>
                            <span class="status-badge status-<?= htmlspecialchars($order['status']) ?>"><?= htmlspecialchars($order['status']) ?></span>
                        </div>
                        <div class="order-meta">
                            <p>Kurir: <?= htmlspecialchars($order['courier']) ?></p>
                            <p>Metode Pembayaran: <?= htmlspecialchars($order['payment_method']) ?></p>
                            <p>Total: Rp <?= number_format($order['total'], 0, ',', '.') ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>
