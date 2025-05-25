<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM books");
$books = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode($books);
?>
