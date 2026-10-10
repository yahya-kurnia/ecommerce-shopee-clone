<?php
session_start();
require_once 'config/database.php';

// Redirect ke login jika belum login
if (!isset($_SESSION['user_id']) && basename($_SERVER['PHP_SELF']) !== 'login.php' && basename($_SERVER['PHP_SELF']) !== 'register.php' && basename($_SERVER['PHP_SELF']) !== 'index.php') {
    header('Location: login.php');
    exit();
}

// Get all products
$stmt = $pdo->query("SELECT * FROM products LIMIT 12");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Shopee Clone</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <!-- Banner -->
    <div class="banner">
        <div class="banner-content">
            <h1>Belanja Sekarang, Hemat Lebih Banyak!</h1>
            <p>Produk Original dengan Harga Terbaik</p>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="search-container">
        <form method="GET" action="search.php" class="search-form">
            <input type="text" name="query" placeholder="Cari produk..." class="search-input" required>
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i> Cari
            </button>
        </form>
    </div>

    <!-- Categories -->
    <div class="categories-section">
        <h2>Kategori Populer</h2>
        <div class="categories-grid">
            <a href="category.php?cat=elektronik" class="category-card">
                <i class="fas fa-laptop"></i>
                <p>Elektronik</p>
            </a>
            <a href="category.php?cat=fashion" class="category-card">
                <i class="fas fa-shirt"></i>
                <p>Fashion</p>
            </a>
            <a href="category.php?cat=makanan" class="category-card">
                <i class="fas fa-utensils"></i>
                <p>Makanan</p>
            </a>
            <a href="category.php?cat=buku" class="category-card">
                <i class="fas fa-book"></i>
                <p>Buku</p>
            </a>
            <a href="category.php?cat=olahraga" class="category-card">
                <i class="fas fa-dumbbell"></i>
                <p>Olahraga</p>
            </a>
            <a href="category.php?cat=rumah" class="category-card">
                <i class="fas fa-home"></i>
                <p>Rumah Tangga</p>
            </a>
        </div>
    </div>

    <!-- Products Section -->
    <div class="products-section">
        <h2>Produk Terbaru</h2>
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <span class="discount-badge">-<?php echo $product['discount']; ?>%</span>
                    </div>
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="product-category"><?php echo htmlspecialchars($product['category']); ?></p>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <span><?php echo $product['rating']; ?> (<?php echo $product['reviews']; ?> ulasan)</span>
                        </div>
                        <div class="product-price">
                            <span class="price-original">Rp <?php echo number_format($product['original_price'], 0, ',', '.'); ?></span>
                            <span class="price-current">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                        </div>
                        <div class="product-sold">
                            <span><?php echo $product['sold']; ?> terjual</span>
                        </div>
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="btn-view-detail">Lihat Detail</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>
