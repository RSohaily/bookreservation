<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$stmt = $pdo->prepare("
    SELECT b.title, b.author
    FROM reservations r
    JOIN books b ON b.id = r.book_id
    WHERE r.user_id = ?
    ORDER BY r.reserved_at DESC
");
$stmt->execute([$_SESSION['user_id']]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($reservations);
