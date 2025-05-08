<?php
session_start();
include 'koneksi.php';

// Hanya admin yang boleh mengakses
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ambil data berdasarkan ID
$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM barang WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

// Proses form jika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pembeli = htmlspecialchars($_POST['nama_pembeli']);
    mysqli_query($conn, "UPDATE barang SET nama_pembeli = '$nama_pembeli' WHERE id = $id");
    header("Location: data.php"); // Kembali ke halaman data setelah update
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Nama Pembeli</title>
    <style>
/* CONTAINER UTAMA */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f4f6f8;
  margin: 0;
  padding: 40px;
}

h2 {
  text-align: center;
  color: #2c3e50;
  margin-bottom: 30px;
}

/* FORM EDIT */
form {
  max-width: 450px;
  margin: auto;
  background-color: #ffffff;
  padding: 25px 30px;
  border-radius: 12px;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: #34495e;
}

input[type="text"] {
  width: 100%;
  padding: 12px 15px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 14px;
  box-sizing: border-box;
  transition: border-color 0.3s;
}

input[type="text"]:focus {
  border-color: #3498db;
  outline: none;
}

/* BUTTON SIMPAN */
button[type="submit"] {
  width: 100%;
  padding: 12px;
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 15px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
  background-color: #2980b9;
}

/* LINK KEMBALI */
a {
  display: block;
  text-align: center;
  margin-top: 20px;
  color: #7f8c8d;
  text-decoration: none;
  font-size: 14px;
}

a:hover {
  color: #2c3e50;
}

    </style>
</head>
<body>

    <h2>Edit Nama Pembeli</h2>
    <form method="POST">
        <label for="nama_pembeli">Nama Pembeli:</label>
        <input type="text" id="nama_pembeli" name="nama_pembeli" value="<?= htmlspecialchars($data['nama_pembeli']) ?>" required>
        <button type="submit">Simpan Perubahan</button>
    </form>
    <a href="sepatu.php">← Kembali ke sepatu</a>

</body>
</html>
