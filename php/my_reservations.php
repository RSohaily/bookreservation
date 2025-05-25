<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>SmartBook – Rezervasyonlarım</title>
  <link rel="stylesheet" href="style.css">
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      loadReservations();

      document.getElementById("logoutBtn").addEventListener("click", () => {
        fetch("logout.php")
          .then(() => window.location.href = "index.html");
      });
    });

    function loadReservations() {
      fetch("get_my_reservations.php")
        .then(res => res.json())
        .then(data => {
          const list = document.getElementById("myList");
          list.innerHTML = "";

          if (data.length === 0) {
            list.innerHTML = "<p>Henüz rezervasyon yapmadınız.</p>";
            return;
          }

          data.forEach(book => {
            const div = document.createElement("div");
            div.className = "book";
            div.innerHTML = `<strong>${book.title}</strong> – ${book.author}<hr>`;
            list.appendChild(div);
          });
        });
    }
  </script>
</head>
<body>
  <div class="container">
    <h1>📖 Rezervasyonlarım</h1>
    <p>Merhaba, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    <button id="logoutBtn">Çıkış Yap</button>
    <p><a href="dashboard.php">← Kitaplara Dön</a></p>

    <div id="myList">Yükleniyor...</div>
  </div>
</body>
</html>
