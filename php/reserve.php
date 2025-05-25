<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo 'unauthorized';
    exit;
}

$book_id = $_POST['book_id'];
$user_id = $_SESSION['user_id'];

// Kitap zaten rezerve edilmiş mi?
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ? AND status = 'available'");
$stmt->execute([$book_id]);

if ($stmt->rowCount() == 0) {
    echo 'already_reserved';
    exit;
}

// Rezerve et
$pdo->prepare("UPDATE books SET status = 'reserved' WHERE id = ?")->execute([$book_id]);

// Kullanıcının rezervasyonunu kaydet
$pdo->prepare("INSERT INTO reservations (user_id, book_id) VALUES (?, ?)")->execute([$user_id, $book_id]);

echo 'success';
?>
