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
        /* Container umum */
.container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
    align-items: flex-start;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
}

/* Bagian teks visi misi */
.text {
    flex: 1 1 400px;
    color: #1e1e2f;
}

.text h3 {
    color: #003049;
    margin-bottom: 8px;
    font-size: 20px;
}

.text p {
    font-size: 16px;
    line-height: 1.6;
    color: #555;
}

/* Bagian video */
.video {
    flex: 1 1 400px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.video video {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

/* Responsif */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
        padding: 15px;
    }

    .text, .video {
        flex: 1 1 100%;
    }

    .video video {
        width: 100%;
    }
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

    <div class="container">
  <div class="text">
    <h3>Visi :</h3>
    <p>Menjadi toko sepatu terkemuka yang menyediakan produk berkualitas tinggi dengan harga terjangkau, serta memberikan pengalaman belanja yang nyaman dan memuaskan bagi pelanggan.</p><br>
    <h3>Misi</h3>
    <p>1.Menjual Produk Berkualitas - Menyediakan berbagai pilihan sepatu dengan bahan berkualitas tinggi dan desain yang stylish.<br>
      2.Pelayanan Pelanggan Terbaik - Mengutamakan kepuasan pelanggan dengan layanan yang cepat, ramah, dan responsif.<br>
      3.Harga Terjangkau - Memberikan harga yang kompetitif tanpa mengorbankan kualitas.<br>
      4.Inovasi & Tren Terbaru - Selalu mengikuti tren mode sepatu terkini untuk memenuhi kebutuhan pelanggan.<br>
      5.Keberlanjutan & Ramah Lingkungan - Berkontribusi dalam penggunaan material ramah lingkungan dan praktik bisnis yang berkelanjutan.</p><br>
  </div>
  <div class="video">
    <video controls width="700">
      <source src="vidcine2.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
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
