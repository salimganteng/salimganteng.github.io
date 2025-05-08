<?php
session_start();
include 'koneksi.php';

if (isset($_POST['id']) && $_SESSION['role'] === 'admin') {
    $id = intval($_POST['id']);
    mysqli_query($conn, "DELETE FROM tambah_barang WHERE id = $id");
}

header('Location: sepatu.php');
exit;
?>
<!DOCTYPE html>
<html lang="id">
<head>
<link rel="stylesheet" href="sukses.css">
<title>Sukses</title>
</head>
<body>
    <div class="berhasil">
        <h2>BARANG BERHASIL DI HAPUS</h2><br>
    </div>

    <div class="sukses">
    <a href="index.php">
        <button type="button">Kembali Ke Halaman Utama</button>
    </a>
</div>
</body>
</html>