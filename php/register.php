<?php
require 'db.php'; // Veritabanı bağlantısı

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($name === '' || $email === '' || $password === '') {
        echo 'Lütfen tüm alanları doldurun.';
        exit;
    }

    // Email zaten kayıtlı mı?
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo 'Bu email zaten kayıtlı.';
        exit;
    }

    // Şifreyi hashle (SHA-256)
    $hashedPassword = hash('sha256', $password);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $result = $stmt->execute([$name, $email, $hashedPassword]);

    echo $result ? 'success' : 'Kayıt sırasında hata oluştu.';
}
?>
