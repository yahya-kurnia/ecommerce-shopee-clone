<?php
session_start();
require_once __DIR__ . '/config/database.php';

$cart = $_SESSION['cart'] ?? [];
$cartItems = [];
$total = 0;

if (!empty($cart)) {
    $placeholders = implode(',', array_fill(0, count($cart), '?'));
    $ids = array_keys($cart);
    $inQuery = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $inQuery . ')');
    $stmt->execute($ids);
    $products = $stmt->fetchAll();

    foreach ($products as $product) {
        $qty = $cart[$product['id']];
        $subtotal = $product['price'] * $qty;
        $total += $subtotal;
        $cartItems[] = [
            'product' => $product,
            'qty' => $qty,
            'subtotal' => $subtotal,
        ];
    }
}

if (isset($_GET['remove'])) {
    $removeId = (int)$_GET['remove'];
    if (isset($cart[$removeId])) {
        unset($cart[$removeId]);
        $_SESSION['cart'] = $cart;
    }
    header('Location: cart.php');
    exit;
}

if (isset($_GET['update'])) {
    $updateId = (int)$_GET['update'];
    $qty = max(1, (int)($_GET['qty'] ?? 1));
    if (isset($cart[$updateId])) {
        $cart[$updateId] = $qty;
        $_SESSION['cart'] = $cart;
    }
    header('Location: cart.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang | Shopee Clone</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <div class="page-container">
        <div class="section-header">
            <h2>Keranjang Belanja</h2>
        </div>

        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_SESSION['flash_success']) ?></div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <?php if (empty($cartItems)): ?>
            <div class="empty-box">
                <p>Keranjang Anda masih kosong.</p>
                <a href="index.php" class="primary-btn">Belanja Sekarang</a>
            </div>
        <?php else: ?>
            <div class="cart-layout">
                <div class="cart-items">
                    <?php foreach ($cartItems as $item): ?>
                        <?php $product = $item['product']; ?>
                        <div class="cart-item">
                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                            <div class="cart-info">
                                <h3><?= htmlspecialchars($product['name']) ?></h3>
                                <p><?= htmlspecialchars($product['category']) ?></p>
                                <div class="cart-price-row">
                                    <span>Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                                </div>
                                <div class="qty-control">
                                    <a href="cart.php?update=<?= (int)$product['id'] ?>&qty=<?= max(1, $item['qty'] - 1) ?>" class="qty-btn">-</a>
                                    <span><?= (int)$item['qty'] ?></span>
                                    <a href="cart.php?update=<?= (int)$product['id'] ?>&qty=<?= $item['qty'] + 1 ?>" class="qty-btn">+</a>
                                </div>
                            </div>
                            <div class="cart-actions">
                                <strong>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></strong>
                                <a href="cart.php?remove=<?= (int)$product['id'] ?>" class="remove-link">Hapus</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <aside class="cart-summary">
                    <h3>Ringkasan Belanja</h3>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong>
                    </div>
                    <div class="summary-row">
                        <span>Pengiriman</span>
                        <strong>Termasuk</strong>
                    </div>
                    <div class="summary-total">
                        <span>Total</span>
                        <strong>Rp <?= number_format($total, 0, ',', '.') ?></strong>
                    </div>
                    <a href="checkout.php" class="primary-btn full-width">Lanjut ke Checkout</a>
                </aside>
            </div>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>
