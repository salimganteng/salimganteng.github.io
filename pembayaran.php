<?php
include_once "koneksi.php";

// Ambil detail produk
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($conn, "SELECT * FROM tambah_barang WHERE id = $id");
    $produk = mysqli_fetch_assoc($query);
    if (!$produk) {
        echo "Produk tidak ditemukan.";
        exit;
    }
} else {
    echo "ID produk tidak diberikan.";
    exit;
}

// Proses pembayaran
if (isset($_POST['simpan'])) {
    $nama        = htmlspecialchars($_POST['nama']);
    $brand       = htmlspecialchars($_POST['brand']);
    $produk_nama = htmlspecialchars($_POST['produk']);
    $alamat      = htmlspecialchars($_POST['alamat']);
    $ukuran      = htmlspecialchars($_POST['ukuran']);
    $jumlah_beli = intval($_POST['jumlah_beli']); // Perbaikan di sini
    $produk_id   = intval($_POST['produk_id']);

    // Cek stok
    $cek_stok = mysqli_query($conn, "SELECT stok FROM tambah_barang WHERE id = $produk_id");
    $stok_data = mysqli_fetch_assoc($cek_stok);

    if ($stok_data && $jumlah_beli <= $stok_data['stok']) {
        // Simpan ke tabel transaksi/pembelian
        $simpan = mysqli_query($conn, "INSERT INTO barang 
            (nama_pembeli, brand, nama_barang, alamat, ukuran, stok) 
            VALUES ('$nama', '$brand', '$produk_nama', '$alamat', '$ukuran', '$jumlah_beli')");

        // Kurangi stok di tabel produk
        $update_stok = mysqli_query($conn, "UPDATE tambah_barang SET stok = stok - $jumlah_beli WHERE id = $produk_id");

        if ($simpan && $update_stok) {
            echo "<script>window.location.href='sukses.php';</script>";
            exit;
        } else {
            echo "<script>alert('Gagal menyimpan atau update stok!');</script>";
        }
    } else {
        echo "<script>alert('Jumlah stok tidak mencukupi!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Sepatu</title>
    <link rel="stylesheet" href="pembayaran.css">
</head>
<body>
    <div class="container">
        <h2>Pembayaran</h2>
        <form method="post">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <label>Brand</label>
                <input type="text" name="brand" value="<?= htmlspecialchars($produk['brand']) ?>" readonly>
            </div>

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="produk" value="<?= htmlspecialchars($produk['name']) ?>" readonly>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat Pengiriman</label>
                <input type="text" id="alamat" name="alamat" required>
            </div>

            <div class="form-group">
                <label for="ukuran">Ukuran Sepatu</label>
                <select id="ukuran" name="ukuran" required>
                    <option value="">Pilih Ukuran</option>
                    <?php for ($i = 39; $i <= 43; $i++) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah_beli">Jumlah Beli</label>
                <input type="number" id="jumlah_beli" name="jumlah_beli" required min="1" max="<?= $produk['stok'] ?>">
            </div>
            
            <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">

            <input type="submit" name="simpan" value="Bayar">
        </form>

        <div class="back-button bottom">
            <a href="anta.php"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</body>
</html>
