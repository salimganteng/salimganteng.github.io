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
        .banner-crop {
    width: 100%;
    height: 300px; /* tinggi crop */
    overflow: hidden;
    border-radius: 10px; /* opsional: buat rounded corner */
    margin-bottom: 10px auto;
}

.banner-crop img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* crop gambar */
    object-position: center; /* fokus tengah */
}
.text {
    text-align: center;
    padding: 60px 20px;
    background-color: #f0f4f8;
    color: #1e1e2f;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
    margin: 30px auto;
    max-width: 700px;
    transition: transform 0.3s ease;
}

.text h1 {
    font-size: 32px;
    margin-bottom: 15px;
    font-weight: 700;
}

.text p {
    font-size: 18px;
    color: #555;
}
.text:hover {
    transform: translateY(-5px);
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

    <div class="banner-crop">
    <img src="images/banner2.jpg" alt="Banner">
</div>

<div class="text">
    <h1>Selamat Datang Di Web Kami</h1>
    <p>Silahkan menjelajah</p>
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
