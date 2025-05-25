<?php
$host = 'sqlXXX.infinityfree.com'; // cPanel'den öğren
$db   = 'epiz_12345678_smartbook'; // veritabanı adı
$user = 'epiz_12345678';           // kullanıcı adı
$pass = 'şifren';                  // sen belirledin

$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     die('Veritabanı bağlantı hatası: ' . $e->getMessage());
}
?>
