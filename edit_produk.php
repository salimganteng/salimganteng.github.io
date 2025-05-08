<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM tambah_barang WHERE id = $id");
$data = mysqli_fetch_assoc($result);

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $stok = (int)$_POST['stok'];
    $harga = (int)$_POST['harga'];

    // Cek apakah gambar baru diupload
    if ($_FILES['image']['error'] === 0) {
        $filename = time() . '_' . $_FILES['image']['name'];
        $filepath = 'uploads/' . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $filepath);
        $query = "UPDATE tambah_barang SET name='$name', stok=$stok, harga=$harga, image='$filename' WHERE id=$id";
    } else {
        $query = "UPDATE tambah_barang SET name='$name', stok=$stok, harga=$harga WHERE id=$id";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Produk berhasil diupdate'); window.location.href='data.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate produk');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f5;
            margin: 0;
            padding: 40px;
        }

        form {
            max-width: 500px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #34495e;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        input[type="file"] {
            padding: 6px;
        }

        p {
            font-size: 14px;
            margin-top: 5px;
            color: #7f8c8d;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

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

<h2>Edit Produk</h2>
<form method="POST" enctype="multipart/form-data">
    <label for="name">Nama Produk:</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($data['name']) ?>" required>

    <label for="stok">Stok:</label>
    <input type="number" name="stok" id="stok" value="<?= htmlspecialchars($data['stok']) ?>" required>

    <label for="harga">Harga:</label>
    <input type="number" name="harga" id="harga" value="<?= htmlspecialchars($data['harga']) ?>" required>

    <label for="image">Gambar Produk:</label>
    <input type="file" name="image" id="image">
    <p>Gambar saat ini: <strong><?= htmlspecialchars($data['image']) ?></strong></p>

    <button type="submit">Simpan Perubahan</button>
</form>
<a href="sepatu.php">← Kembali ke sepatu</a>

</body>
</html>
