<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>SmartBook – Kitaplar</title>
  <link rel="stylesheet" href="style.css">
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      fetchBooks();

      document.getElementById("logoutBtn").addEventListener("click", () => {
        fetch("logout.php")
          .then(() => window.location.href = "index.html");
      });
    });

    function fetchBooks() {
      fetch("books.php")
        .then(res => res.json())
        .then(data => {
          const list = document.getElementById("bookList");
          list.innerHTML = "";
          data.forEach(book => {
            const div = document.createElement("div");
            div.className = "book";
            div.innerHTML = `
              <strong>${book.title}</strong> – ${book.author}<br>
              Durum: ${book.status === "available" ? "Uygun" : "Rezerve Edilmiş"}
              ${book.status === "available" ? `<button onclick="reserveBook(${book.id})">Rezerve Et</button>` : ""}
              <hr>
            `;
            list.appendChild(div);
          });
        });
    }

    function reserveBook(bookId) {
      const formData = new FormData();
      formData.append("book_id", bookId);

      fetch("reserve.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.text())
      .then(response => {
        if (response === "success") {
          alert("Kitap başarıyla rezerve edildi.");
          fetchBooks();
        } else if (response === "already_reserved") {
          alert("Bu kitap zaten rezerve edilmiş.");
        } else {
          alert("Rezervasyon sırasında hata oluştu.");
        }
      });
    }
  </script>
</head>
<body>
  <div class="container">
    <h1>📚 SmartBook</h1>
    <p>Hoş geldiniz, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    <button id="logoutBtn">Çıkış Yap</button>

    <h2>Kitaplar</h2>
    <div id="bookList">Yükleniyor...</div>
  </div>
</body>
</html>
