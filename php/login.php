<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $hashedPassword = hash('sha256', $password);

    $stmt = $pdo->prepare("SELECT id, name FROM users WHERE email = ? AND password = ?");
    $stmt->execute([$email, $hashedPassword]);

    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        echo 'success';
    } else {
        echo 'Email ya da şifre hatalı.';
    }
}
?>
