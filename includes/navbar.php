<?php
session_start();
require_once __DIR__ . '/config/database.php';

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($productId <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id LIMIT 1');
$stmt->execute(['id' => $productId]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: index.php');
    exit;
}

$related = $pdo->prepare('SELECT * FROM products WHERE category = :category AND id != :id ORDER BY created_at DESC LIMIT 4');
$related->execute(['category' => $product['category'], 'id' => $product['id']]);
$relatedProducts = $related->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> | Shopee Clone</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <div class="page-container product-detail-page">
        <div class="product-detail">
            <div class="product-detail-image">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            </div>
            <div class="product-detail-info">
                <span class="product-tag"><?= htmlspecialchars($product['category']) ?></span>
                <h1><?= htmlspecialchars($product['name']) ?></h1>
                <div class="product-rating-row">
                    <span><i class="fas fa-star"></i> <?= htmlspecialchars($product['rating']) ?></span>
                    <span><?= htmlspecialchars($product['reviews']) ?> ulasan</span>
                    <span><?= htmlspecialchars($product['sold']) ?> terjual</span>
                </div>
                <div class="detail-price-box">
                    <span class="old-price">Rp <?= number_format($product['original_price'], 0, ',', '.') ?></span>
                    <span class="new-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                    <span class="discount-pill">Diskon <?= (int)$product['discount'] ?>%</span>
                </div>
                <p class="product-description"><?= htmlspecialchars($product['description']) ?></p>
                <div class="product-actions">
                    <a href="cart.php?add=<?= (int)$product['id'] ?>&qty=1" class="secondary-btn">Tambah ke Keranjang</a>
                    <a href="checkout.php" class="primary-btn">Beli Sekarang</a>
                </div>
            </div>
        </div>

        <div class="related-products">
            <div class="section-header">
                <h2>Produk Terkait</h2>
            </div>
            <div class="product-grid">
                <?php foreach ($relatedProducts as $item): ?>
                    <div class="product-card">
                        <div class="product-image-wrap">
                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                        </div>
                        <div class="product-body">
                            <h3><?= htmlspecialchars($item['name']) ?></h3>
                            <div class="price-box">
                                <span class="price-now">Rp <?= number_format($item['price'], 0, ',', '.') ?></span>
                            </div>
                            <a href="product.php?id=<?= (int)$item['id'] ?>" class="detail-btn">Lihat</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>
