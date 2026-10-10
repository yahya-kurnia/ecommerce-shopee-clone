<?php
$cartCount = array_sum($_SESSION['cart'] ?? []);
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar">
    <div class="container nav-inner">
        <a href="index.php" class="logo">Shopee<span>Clone</span></a>
        <div class="nav-links">
            <a href="index.php" class="<?= $currentPage === 'index.php' ? 'active' : '' ?>">Beranda</a>
            <a href="index.php#products">Produk</a>
            <a href="cart.php">Keranjang <span class="cart-badge"><?= $cartCount ?></span></a>
            <a href="orders.php">Pesanan</a>
        </div>
        <div class="nav-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="username">Halo, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <a href="logout.php" class="secondary-btn small">Keluar</a>
            <?php else: ?>
                <a href="login.php" class="secondary-btn small">Masuk</a>
                <a href="register.php" class="primary-btn small">Daftar</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
