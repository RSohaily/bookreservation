<head>
    <link rel="stylesheet" href="php/style.css"> <!-- Eğer php klasöründeyse -->
</head>

<?php
session_start();

// Kullanıcı giriş yapmamışsa login sayfasına yönlendir
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

// Veritabanı bağlantısını ekle
require 'php/db_connect.php';

// Kullanıcı bilgilerini çek
$user_id = $_SESSION['user_id'];
$query = "SELECT name FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Hoşgeldiniz, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <p>Burası senin kitap rezervasyon sistemindeki profil sayfan.</p>

        <h2>📚 Kiraladığınız Kitaplar</h2>
        <table>
            <tr>
                <th>Kitap Adı</th>
                <th>Yazar</th>
                <th>Kiralama Tarihi</th>
                <th>İade Tarihi</th>
            </tr>

            <?php
            $query = "SELECT books.title, books.author, rentals.rental_date, rentals.return_date 
                      FROM rentals 
                      JOIN books ON rentals.book_id = books.id 
                      WHERE rentals.user_id = '$user_id'";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['title']}</td>
                        <td>{$row['author']}</td>
                        <td>{$row['rental_date']}</td>
                        <td>{$row['return_date']}</td>
                      </tr>";
            }
            ?>
        </table>

        <p><a href="logout.php">Çıkış Yap</a></p>
    </div>
</body>
</html>
