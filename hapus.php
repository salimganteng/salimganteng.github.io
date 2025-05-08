<?php
session_start();
include 'koneksi.php';

// Pastikan hanya admin yang bisa menghapus
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    die("Akses ditolak.");
}

// Validasi ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data dari database
    $query = mysqli_query($conn, "DELETE FROM barang WHERE id = $id");

    if ($query) {
        header("Location: data_pembeli.php?pesan=hapus_sukses");
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID tidak valid.";
}
?>
