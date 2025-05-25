<head>
    <link rel="stylesheet" href="php/style.css"> <!-- Eğer php klasöründeyse -->
</head>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Kullanıcı giriş yapmamışsa giriş sayfasına yönlendir
    header('Location: login.html');
    exit;
}
// Kullanıcı giriş yapmışsa devam eder
echo "Merhaba, " . htmlspecialchars($_SESSION['username']);
?>
