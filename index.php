<?php
session_start();
require_once __DIR__ . '/config/database.php';

$products = $pdo->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 8")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee Clone | Beranda</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <section class="hero">
        <div class="hero-content">
            <span class="mini-label">Belanja Lebih Mudah</span>
            <h1>Produk Terbaik, Harga Lebih Hemat</h1>
            <p>Belanja kebutuhan harian, gadget, fashion, dan produk favorit Anda dengan promo menarik setiap hari.</p>
            <div class="hero-actions">
                <a href="#products" class="primary-btn">Belanja Sekarang</a>
                <a href="login.php" class="secondary-btn">Masuk / Daftar</a>
            </div>
            <div class="stats">
                <div>
                    <strong>50K+</strong>
                    <span>Produk</span>
                </div>
                <div>
                    <strong>1.2Jt</strong>
                    <span>Pelanggan</span>
                </div>
                <div>
                    <strong>24 Jam</strong>
                    <span>CS Online</span>
                </div>
            </div>
        </div>
        <div class="hero-banner">
            <img src="https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=900&q=80" alt="banner">
        </div>
    </section>

    <section class="categories">
        <div class="section-header">
            <h2>Kategori Pilihan</h2>
        </div>
        <div class="category-grid">
            <div class="category-item">
                <i class="fas fa-laptop"></i>
                <span>Elektronik</span>
            </div>
            <div class="category-item">
                <i class="fas fa-tshirt"></i>
                <span>Fashion</span>
            </div>
            <div class="category-item">
                <i class="fas fa-couch"></i>
                <span>Rumah Tangga</span>
            </div>
            <div class="category-item">
                <i class="fas fa-book"></i>
                <span>Buku</span>
            </div>
            <div class="category-item">
                <i class="fas fa-basketball-ball"></i>
                <span>Olahraga</span>
            </div>
            <div class="category-item">
                <i class="fas fa-utensils"></i>
                <span>Makanan</span>
            </div>
        </div>
    </section>

    <section id="products" class="products-section">
        <div class="section-header">
            <h2>Produk Terbaru</h2>
        </div>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image-wrap">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        <span class="discount-tag">-<?= (int)$product['discount'] ?>%</span>
                    </div>
                    <div class="product-body">
                        <div class="product-meta">
                            <span class="product-category"><?= htmlspecialchars($product['category']) ?></span>
                            <span class="product-rating"><i class="fas fa-star"></i> <?= htmlspecialchars($product['rating']) ?></span>
                        </div>
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <div class="price-box">
                            <span class="price-old">Rp <?= number_format($product['original_price'], 0, ',', '.') ?></span>
                            <span class="price-now">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                        </div>
                        <div class="product-foot">
                            <span><?= htmlspecialchars($product['sold']) ?> terjual</span>
                            <a href="product.php?id=<?= (int)$product['id'] ?>" class="detail-btn">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>

