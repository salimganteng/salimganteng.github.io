<?php
session_start(); 
include 'koneksi.php';
$menu = [
    'index' => 'Home',
    'sepatu' => 'Sepatu',
    'tentang' => 'Tentang'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yepatu</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
    <style>
* {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      height: 100vh;
      background: linear-gradient(to right, #f2f2f2, #dfe9f3);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .menu {
  position: fixed;
  bottom: 350px; /* jarak dari bawah halaman */
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-direction: column;
  gap: 20px;
  background: white;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
  text-align: center;
}

    .menu a {
      text-decoration: none;
      background-color: #3498db;
      color: white;
      padding: 12px 25px;
      border-radius: 8px;
      font-size: 18px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .menu a:hover {
      background-color: #2980b9;
      transform: scale(1.05);
    }
  </style>
<div class="navbar">
        <?php foreach ($menu as $key => $value) : ?>
            <a href="<?= $key ?>.php"> <?= $value ?> </a>
        <?php endforeach; ?>

        <!-- Cek apakah pengguna login sebagai admin -->
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] === 'admin') : ?>
            <a href="data.php">Data</a> <!-- Opsi tambahan untuk admin -->
        <?php endif; ?>

        <!-- Cek apakah pengguna sudah login -->
        <?php if (isset($_SESSION['user'])) : ?>
            <a href="logout.php">Logout</a>
        <?php else : ?>
            |<a href="login.php">Login</a>
            <a href="register.php">Daftar</a>
        <?php endif; ?>
    </div>

    <div class="menu">
    <a href="data_pembeli.php">Data Pembeli</a>
    <a href="tambah_barang.php">Tambah Barang</a>
        </div>


<!-- Footer -->
<footer class="footer">
    <p>&copy; <?= date("Y"); ?> Yepatu. Semua Hak Dilindungi.</p>
    <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-whatsapp"></i></a>
    </div>
</footer>

</body>
</html>
