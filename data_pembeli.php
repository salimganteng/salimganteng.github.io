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
/* TABEL UTAMA */
table {
  width: 95%;
  margin: 20px auto;
  border-collapse: collapse;
  background-color: #fff;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
  border-radius: 10px;
  overflow: hidden;
}

th, td {
  padding: 14px 18px;
  text-align: center;
  border-bottom: 1px solid #eee;
}

th {
  background-color: #3498db;
  color: white;
  text-transform: uppercase;
  font-weight: bold;
  font-size: 14px;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

tr:hover {
  background-color: #f1f1f1;
}

/* TOMBOL AKSI */
td a {
  text-decoration: none;
  padding: 6px 12px;
  margin: 2px;
  font-size: 13px;
  border-radius: 5px;
  display: inline-block;
  transition: all 0.2s ease-in-out;
}

/* Tombol Edit */
td a[href^="edit.php"] {
  background-color: #f39c12;
  color: white;
}

td a[href^="edit.php"]:hover {
  background-color: #e67e22;
}

/* Tombol Hapus */
td a[href^="hapus.php"] {
  background-color: #e74c3c;
  color: white;
}

td a[href^="hapus.php"]:hover {
  background-color: #c0392b;
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
    <table>
    <tr>
        <th>No</th>
        <th>Nama Pembeli</th>
        <th>Nama Barang</th>
        <th>Ukuran</th>
        <th>Stok</th>
        <th>Alamat</th>
        <th>Ket</th>
    </tr>
    <?php
    $no = 1;
    $data = mysqli_query($conn, "SELECT * FROM barang");
    while($row = mysqli_fetch_array($data)) {
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama_pembeli']) ?></td>
        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
        <td><?= htmlspecialchars($row['ukuran']) ?></td>
        <td><?= htmlspecialchars($row['stok']) ?></td>
        <td><?= htmlspecialchars($row['alamat']) ?></td>
        <td>
            <?php if (isset($_SESSION['user']) && $_SESSION['role'] === 'admin') : ?>
                <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
            <?php endif; ?>
        </td>
        <td>
</td>

    </tr>
    <?php } ?>
</table>


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
