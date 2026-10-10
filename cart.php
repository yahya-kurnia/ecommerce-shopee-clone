<?php
session_start();
require_once __DIR__ . '/config/database.php';

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$qty = isset($_GET['qty']) ? max(1, (int)$_GET['qty']) : 1;

if ($productId <= 0) {
    $_SESSION['flash_error'] = 'Produk tidak valid.';
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id LIMIT 1');
$stmt->execute(['id' => $productId]);
$product = $stmt->fetch();

if (!$product) {
    $_SESSION['flash_error'] = 'Produk tidak ditemukan.';
    header('Location: index.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];
if (isset($cart[$productId])) {
    $cart[$productId] += $qty;
} else {
    $cart[$productId] = $qty;
}

$_SESSION['cart'] = $cart;
$_SESSION['flash_success'] = 'Produk berhasil ditambahkan ke keranjang.';
header('Location: cart.php');
exit;
