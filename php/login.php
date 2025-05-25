<?php
session_start();
require 'db_connect.php'; // Make sure this file contains the correct DB login info

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Secure query with prepared statement
    $query = "SELECT id, name, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];

        // Redirect to books page after successful login
        header("Location: books.html");
        exit;
    } else {
        echo "<script>alert('Giriş bilgileri yanlış! Tekrar deneyin.');</script>";
    }
}
?>
