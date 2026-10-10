<?php
session_start();
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');

    if ($name === '' || $email === '' || $password === '') {
        $_SESSION['flash_error'] = 'Nama, email, dan password wajib diisi.';
        header('Location: register.php');
        exit;
    }

    $check = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $check->execute(['email' => $email]);
    if ($check->fetch()) {
        $_SESSION['flash_error'] = 'Email sudah terdaftar. Silakan gunakan email lain.';
        header('Location: register.php');
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO users (name, email, password, phone, address) VALUES (:name, :email, :password, :phone, :address)');
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'password' => $hash,
        'phone' => $phone,
        'address' => $address,
    ]);

    $_SESSION['flash_success'] = 'Pendaftaran berhasil. Silakan login.';
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Shopee Clone</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="auth-body">
    <div class="auth-container">
        <div class="auth-card">
            <h2>Buat Akun Baru</h2>
            <?php if (!empty($_SESSION['flash_error'])): ?>
                <div class="alert alert-error"><?= htmlspecialchars($_SESSION['flash_error']) ?></div>
                <?php unset($_SESSION['flash_error']); ?>
            <?php endif; ?>
            <?php if (!empty($_SESSION['flash_success'])): ?>
                <div class="alert alert-success"><?= htmlspecialchars($_SESSION['flash_success']) ?></div>
                <?php unset($_SESSION['flash_success']); ?>
            <?php endif; ?>
            <form method="POST" class="auth-form">
                <div class="field-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" placeholder="Nama lengkap" required>
                </div>
                <div class="field-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="contoh@email.com" required>
                </div>
                <div class="field-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" placeholder="08xxxxxxxxxx">
                </div>
                <div class="field-group">
                    <label for="address">Alamat</label>
                    <textarea id="address" name="address" rows="3" placeholder="Alamat lengkap"></textarea>
                </div>
                <div class="field-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>
                </div>
                <button type="submit" class="primary-btn full-width">Daftar</button>
            </form>
            <p class="auth-link">Sudah punya akun? <a href="login.php">Masuk</a></p>
            <p class="auth-link"><a href="index.php">Kembali ke beranda</a></p>
        </div>
    </div>
</body>
</html>
