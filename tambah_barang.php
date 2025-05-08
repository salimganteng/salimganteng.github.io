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
    form {
        max-width: 500px;
        margin: 30px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }

    form label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #003049;
    }

    form input[type="text"],
    form input[type="number"],
    form input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 1rem;
    }

    form button[type="submit"] {
        background-color: #003049;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    form button[type="submit"]:hover {
        background-color: #ffba08;
        color: #003049;
    }

    .navbar a {
        margin-right: 10px;
        text-decoration: none;
        color:rgb(243, 243, 243);
        font-weight: bold;
    }
</style>

<!-- Navigasi -->
<div class="navbar">
    <?php foreach ($menu as $key => $value) : ?>
        <a href="<?= $key ?>.php"><?= $value ?></a>
    <?php endforeach; ?>

    <?php if (isset($_SESSION['user']) && $_SESSION['role'] === 'admin') : ?>
        <a href="data.php">Data</a>
    <?php endif; ?>

    <?php if (isset($_SESSION['user'])) : ?>
        <a href="logout.php">Logout</a>
    <?php else : ?>
        <a href="login.php">Login</a>
        <a href="register.php">Daftar</a>
    <?php endif; ?>
</div>

<?php
// Proses form
if (isset($_POST['submit'])) {
    $brand = mysqli_real_escape_string($conn, trim($_POST['brand']));
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $harga = intval($_POST['harga']);
    $stok = intval($_POST['stok']);

    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $uploadDir = 'uploads/';
    $imagePath = $uploadDir . basename($imageName);

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($imageTmp, $imagePath)) {
        $query = "INSERT INTO tambah_barang (image, brand, name, harga, stok) 
                  VALUES ('$imageName', '$brand', '$name', '$harga', '$stok')";

        $result = mysqli_query($conn, $query) or die("Query error: " . mysqli_error($conn));

        if ($result) {
            // Alihkan ke sepatu.php yang menampilkan semua produk
            header("Location: sepatu.php");
            exit;
        } else {
            echo "Gagal menyimpan data ke database.";
        }
    } else {
        echo "Gagal mengunggah gambar.";
    }
}
?>

<!-- Form Tambah Barang -->
<form action="" method="post" autocomplete="off" enctype="multipart/form-data">
    <label for="image">Foto Produk:</label>
    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required>

    <label for="brand">Brand:</label>
    <input type="text" name="brand" id="brand" placeholder="Masukan Brand" value="" required>

    <label for="name">Nama Produk:</label>
    <input type="text" name="name" id="name" placeholder="Masukan Nama" value="" required>

    <label for="stok">Stok:</label>
    <input type="number" name="stok" id="stok" placeholder="Masukan Stok" value="" required min="1">

    <label for="harga">Harga:</label>
    <input type="number" name="harga" id="harga" placeholder="Masukan Harga" value="" required>

    <button type="submit" name="submit">Submit</button>
</form>

<!-- Footer -->
<footer class="footer" style="text-align:center; padding:20px; margin-top:40px; background:#f0f0f0;">
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
